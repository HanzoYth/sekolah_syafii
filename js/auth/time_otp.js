let timer = document.getElementById("timer");

let inp_otp = document.querySelectorAll(".otp-field");
let button_verify_otp = document.querySelector(".btn-verify");
let inp_value_otp = document.getElementById("value_otp");


let [menit, detik] = timer.textContent.split(":").map(Number);

let waktu = menit * 60 + detik;


const setWaktu = setInterval(() => {
    let m = Math.floor(waktu / 60);
    let d = waktu % 60;

    d = d.toString().padStart(2,"0");

    timer.textContent = `${m}:${d}`;

    waktu--;

    if (waktu < 0){
        clearInterval(setWaktu);
        timer.textContent = "0:00";
    }
},1000)


var kode_otp = "";

inp_otp.forEach((data,idx) => {
    data.addEventListener("keydown",(e) => {
        if (e.key == "Backspace"){
            if ((idx - 1) > -1){
                data.setAttribute("disabled","");
                inp_otp[idx - 1].removeAttribute("disabled");
                inp_otp[idx - 1].focus();
                kode_otp = "";
            }
            data.value != "" ? data.value = "" : inp_otp[(idx - 1) <= 0 ? 0 : idx-1].value = "";
        }
    })
    data.addEventListener("input",() => {
        if (this.value != ""){
            if ((idx + 1) < 6){
                data.setAttribute("disabled","");
                inp_otp[idx + 1].removeAttribute("disabled");
                inp_otp[idx + 1].focus();
            }
        }
        if (inp_otp[5].value != ""){
            inp_otp.forEach((data1) => {
                kode_otp += data1.value;
            })
            inp_value_otp.value = kode_otp;  
        }
    });
})
