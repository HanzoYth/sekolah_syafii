import fs from 'node:fs';
import path from 'node:path';
import { spawn } from 'node:child_process';
import { pathToFileURL } from 'node:url';

const CHROME_PATH = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
const CDP_PORT = 9223;
const USER_DATA_DIR = 'C:\\Users\\USER\\.gemini\\antigravity\\brain\\6feda821-e7a4-4c18-8f97-c882c8c6085f\\scratch\\chrome_prof_verify';
const HTML_FILE = 'C:\\Users\\USER\\.gemini\\antigravity\\brain\\6feda821-e7a4-4c18-8f97-c882c8c6085f\\scratch\\verify_html\\gian_rapor_clean.html';
const OUT_SCREENSHOT = 'C:\\Users\\USER\\.gemini\\antigravity\\brain\\6feda821-e7a4-4c18-8f97-c882c8c6085f\\gian_rapor_prestasi_clean.png';

async function waitPort(port, maxTries = 30) {
    for (let i = 0; i < maxTries; i++) {
        try {
            const res = await fetch(`http://127.0.0.1:${port}/json/list`);
            const data = await res.json();
            if (Array.isArray(data) && data.length > 0) return data;
        } catch (e) {}
        await new Promise(r => setTimeout(r, 200));
    }
    throw new Error('Chrome did not open CDP in time');
}

function connectWs(wsUrl) {
    return new Promise((resolve, reject) => {
        const ws = new WebSocket(wsUrl);
        let nextId = 1;
        const pending = new Map();
        const listeners = [];

        ws.addEventListener('open', () => resolve({
            send(method, params = {}) {
                return new Promise((res, rej) => {
                    const id = nextId++;
                    pending.set(id, { res, rej });
                    ws.send(JSON.stringify({ id, method, params }));
                });
            },
            onEvent(fn) {
                listeners.push(fn);
            },
            close() {
                ws.close();
            }
        }));
        ws.addEventListener('error', reject);
        ws.addEventListener('message', (ev) => {
            const msg = JSON.parse(ev.data);
            if (msg.id && pending.has(msg.id)) {
                const { res, rej } = pending.get(msg.id);
                pending.delete(msg.id);
                if (msg.error) rej(new Error(msg.error.message));
                else res(msg.result);
            } else if (msg.method) {
                for (const fn of listeners) fn(msg.method, msg.params);
            }
        });
    });
}

(async () => {
    console.log('Spawning headless Chrome...');
    const chromeProc = spawn(CHROME_PATH, [
        `--remote-debugging-port=${CDP_PORT}`,
        `--user-data-dir=${USER_DATA_DIR}`,
        '--headless=new',
        '--disable-gpu',
        '--no-first-run',
        '--no-default-browser-check',
        'about:blank'
    ]);

    try {
        const targets = await waitPort(CDP_PORT);
        const pageTarget = targets.find(t => t.type === 'page') || targets[0];
        const cdp = await connectWs(pageTarget.webSocketDebuggerUrl);

        await cdp.send('Page.enable');
        await cdp.send('Runtime.enable');
        await cdp.send('Emulation.setDeviceMetricsOverride', {
            width: 1200,
            height: 1000,
            deviceScaleFactor: 1,
            mobile: false
        });

        // First navigate to the page to set domain localStorage
        const fileUrl = pathToFileURL(HTML_FILE).href;
        await cdp.send('Page.navigate', { url: fileUrl });
        await new Promise(r => setTimeout(r, 600));

        // Inject stale "test" draft into localStorage to verify our auto-clean and defense
        await cdp.send('Runtime.evaluate', {
            expression: `
                localStorage.setItem('siakad_rapor_custom_2', JSON.stringify({
                    prestasi: ['test', 'prestasi palsu'],
                    catatan: 'Catatan palsu'
                }));
            `
        });
        console.log('Injected stale draft with "test" into localStorage.');

        // Reload page to simulate user opening raporSiswa with existing dirty localStorage
        await cdp.send('Page.reload');
        await new Promise(r => setTimeout(r, 800));

        // Evaluate the DOM and localStorage
        const evalRes = await cdp.send('Runtime.evaluate', {
            expression: `
                (() => {
                    const pb = document.getElementById('studentPrestasiBody');
                    const text = pb ? pb.innerText : '';
                    const rawStorage = localStorage.getItem('siakad_rapor_custom_2');
                    return {
                        prestasiBodyText: text,
                        hasTestInDOM: text.toLowerCase().includes('test'),
                        cleanedStorage: rawStorage
                    };
                })()
            `,
            returnByValue: true
        });

        console.log('Verification Result in Browser:');
        console.log(JSON.stringify(evalRes.result.value, null, 2));

        // Scroll into view of studentPrestasiBody and take screenshot
        await cdp.send('Runtime.evaluate', {
            expression: `
                const pb = document.getElementById('studentPrestasiBody');
                if (pb) pb.scrollIntoView({ block: 'center' });
            `
        });
        await new Promise(r => setTimeout(r, 400));

        const { data } = await cdp.send('Page.captureScreenshot', { format: 'png' });
        fs.writeFileSync(OUT_SCREENSHOT, Buffer.from(data, 'base64'));
        console.log(`Saved screenshot to: ${OUT_SCREENSHOT} (${fs.statSync(OUT_SCREENSHOT).size} bytes)`);

        cdp.close();
    } finally {
        chromeProc.kill();
    }
})();
