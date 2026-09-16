document.addEventListener("DOMContentLoaded", () => {
    const overlay     = document.getElementById("loadingOverlay");
    const wrapper     = document.getElementById("otpWrapper");
    const inpOtp      = document.querySelectorAll(".otp-field");
    const inpValueOtp = document.getElementById("value_otp");
    const timerEl     = document.getElementById("timer");
    const csrfToken   = document.querySelector('meta[name="csrf-token"]').content;

    const MIN_LOADING = 600; // ms, biar spinner minimal sempat kelihatan
    const startTime = performance.now();

    fetch("/gr/otp")
    .then((res) => {
        if (!res.ok) throw new Error("Gagal membuat OTP");
        return res.json();
    })
    .then((data) => {
        const elapsed = performance.now() - startTime;
        const delay = Math.max(MIN_LOADING - elapsed, 0);

        setTimeout(() => {
            overlay.classList.add("hide");
            wrapper.classList.add("show");
            isiOtpOtomatis(String(data.kode_otp));
            mulaiTimer(data.expired_in);
        }, delay);
    })
    .catch((err) => {
        overlay.querySelector(".loading-text").textContent =
            "Gagal memuat kode OTP, silakan muat ulang halaman.";
        console.error(err);
    });

    function isiOtpOtomatis(kode) {
        kode.split("").forEach((digit, idx) => {
            inpOtp[idx].removeAttribute("disabled");
            inpOtp[idx].value = digit;
        });
        inpValueOtp.value = kode;
    }

    function mulaiTimer(sisaDetik) {
        let waktu = sisaDetik;
        const setWaktu = setInterval(() => {
            const m = Math.floor(waktu / 60);
            const d = (waktu % 60).toString().padStart(2, "0");
            timerEl.textContent = `${m}:${d}`;
            waktu--;
            if (waktu < 0) {
                clearInterval(setWaktu);
                timerEl.textContent = "0:00";
            }
        }, 1000);
    }

    // navigasi antar kotak input saat user mengetik manual
    inpOtp.forEach((el, idx) => {
        el.addEventListener("keydown", (e) => {
            if (e.key === "Backspace") {
                if (idx - 1 > -1) {
                    el.setAttribute("disabled", "");
                    inpOtp[idx - 1].removeAttribute("disabled");
                    inpOtp[idx - 1].focus();
                }
                el.value !== "" ? (el.value = "") : (inpOtp[idx - 1 <= 0 ? 0 : idx - 1].value = "");
            }
        });
        el.addEventListener("input", function () {
            if (this.value !== "" && idx + 1 < 6) {
                el.setAttribute("disabled", "");
                inpOtp[idx + 1].removeAttribute("disabled");
                inpOtp[idx + 1].focus();
            }
            if (inpOtp[5].value !== "") {
                let kode = "";
                inpOtp.forEach((d) => (kode += d.value));
                inpValueOtp.value = kode;
            }
        });
    });
});