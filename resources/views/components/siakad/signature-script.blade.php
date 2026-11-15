<script>
    /**
     * Algoritma Penghapus Background Tanda Tangan Otomatis (HTML5 Canvas Pixel Filter).
     * Mengubah latar kertas terang/putih menjadi PNG transparan seketika di browser.
     */
    if (typeof window.removeSignatureBackground !== 'function') {
        window.removeSignatureBackground = function(file, callback) {
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    let width = img.width;
                    let height = img.height;
                    const maxW = 600;
                    const maxH = 350;
                    if (width > maxW) {
                        height = Math.round((height * maxW) / width);
                        width = maxW;
                    }
                    if (height > maxH) {
                        width = Math.round((width * maxH) / height);
                        height = maxH;
                    }

                    const canvas = document.createElement('canvas');
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    const imgData = ctx.getImageData(0, 0, width, height);
                    const d = imgData.data;
                    const threshold = 205;

                    for (let i = 0; i < d.length; i += 4) {
                        const origAlpha = d[i + 3];
                        if (origAlpha < 15) {
                            d[i + 3] = 0;
                            continue;
                        }
                        const luminance = 0.299 * d[i] + 0.587 * d[i + 1] + 0.114 * d[i + 2];
                        if (luminance >= threshold) {
                            d[i + 3] = 0;
                        } else {
                            const factor = (threshold - luminance) / threshold;
                            d[i + 3] = Math.min(origAlpha, Math.max(0, Math.round(factor * 340)));
                        }
                    }

                    ctx.putImageData(imgData, 0, 0);
                    callback(canvas.toDataURL('image/png'));
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        };
    }
</script>
