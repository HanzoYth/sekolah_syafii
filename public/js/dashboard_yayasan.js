/* ==========================================================================
   HELPER
   ========================================================================== */

function formatRupiah(angka) {
    return "Rp " + Math.round(angka).toLocaleString("id-ID");
}

/* ==========================================================================
   AMBIL DATA DARI SERVER (mingguan / bulanan)
   ========================================================================== */

async function fetchGrafikData(jenis, periode, paramTanggal) {
    try {
        const params = new URLSearchParams({ jenis, periode });

        if (periode === "mingguan") {
            params.set("tanggal", paramTanggal);
        } else {
            params.set("bulan", paramTanggal);
        }

        const res = await fetch(`/grafik-keuangan?${params.toString()}`);

        if (!res.ok) {
            throw new Error("Gagal mengambil data grafik");
        }

        const dat = await res.json();

        return { labels: dat.labels, data: dat.data };

    } catch (err) {
        console.error(err);
        return { labels: [], data: [] };
    }
}

/* ==========================================================================
   CHART RENDERING
   ========================================================================== */

const chartInstances = {
    pendapatan: null,
    tunggakan: null
};

const WARNA = {
    pendapatan: { line: "#4F46E5", fillTop: "rgba(79, 70, 229, 0.28)", fillBottom: "rgba(79, 70, 229, 0)" },
    tunggakan: { line: "#F43F5E", fillTop: "rgba(244, 63, 94, 0.24)", fillBottom: "rgba(244, 63, 94, 0)" }
};

function renderChart(jenis, labels, data) {
    const canvasId = jenis === "pendapatan" ? "chartPendapatan" : "chartTunggakan";
    const canvas = document.getElementById(canvasId);
    const ctx = canvas.getContext("2d");

    if (chartInstances[jenis]) {
        chartInstances[jenis].destroy();
    }

    const gradient = ctx.createLinearGradient(0, 0, 0, canvas.parentElement.clientHeight);
    gradient.addColorStop(0, WARNA[jenis].fillTop);
    gradient.addColorStop(1, WARNA[jenis].fillBottom);

    chartInstances[jenis] = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                data: data,
                borderColor: WARNA[jenis].line,
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointRadius: labels.length > 15 ? 0 : 4,
                pointBackgroundColor: WARNA[jenis].line,
                pointBorderColor: "#FFFFFF",
                pointBorderWidth: 2,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => formatRupiah(ctx.parsed.y)
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false }
                },
                y: {
                    grid: { color: "#E7E9F1" },
                    ticks: {
                        callback: (value) => "Rp " + (value / 1000000) + "jt"
                    }
                }
            }
        }
    });

    // Update ringkasan chip
    const card = canvas.closest(".chart-card");
    const total = data.reduce((a, b) => a + b, 0);
    const rata = data.length ? total / data.length : 0;
    card.querySelector(".chart-total").textContent = formatRupiah(total);
    card.querySelector(".chart-avg").textContent = formatRupiah(rata);
}

/* ==========================================================================
   KONTROL: tab periode + input tanggal/bulan
   ========================================================================== */

function initChartControls(jenis) {
    const group = document.querySelector(`.chart-controls[data-chart-group="${jenis}"]`);
    const periodButtons = group.querySelectorAll(".period-btn");
    const dateInput = group.querySelector('[data-period-input="mingguan"]');
    const monthInput = group.querySelector('[data-period-input="bulanan"]');

    // set nilai default: tanggal hari ini & bulan sekarang
    const now = new Date();
    dateInput.value = now.toISOString().slice(0, 10);
    monthInput.value = now.toISOString().slice(0, 7);

    async function renderSesuaiPeriode(periode) {
        const paramTanggal = periode === "mingguan" ? dateInput.value : monthInput.value;
        const { labels, data } = await fetchGrafikData(jenis, periode, paramTanggal);
        renderChart(jenis, labels, data);
    }

    periodButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            periodButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            const periode = btn.dataset.period;
            dateInput.classList.toggle("hide", periode !== "mingguan");
            monthInput.classList.toggle("hide", periode !== "bulanan");

            renderSesuaiPeriode(periode);
        });
    });

    dateInput.addEventListener("change", () => renderSesuaiPeriode("mingguan"));
    monthInput.addEventListener("change", () => renderSesuaiPeriode("bulanan"));

    // render awal
    renderSesuaiPeriode("mingguan");
}

/* ==========================================================================
   INIT
   ========================================================================== */

document.addEventListener("DOMContentLoaded", () => {
    const today = new Date();
    document.getElementById("todayDate").textContent = today.toLocaleDateString("id-ID", {
        weekday: "long", day: "numeric", month: "long", year: "numeric"
    });

    initChartControls("pendapatan");
    initChartControls("tunggakan");
});