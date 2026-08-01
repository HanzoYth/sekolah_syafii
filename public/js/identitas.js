const role = document.getElementById("role_type");
const total = document.getElementById("total");
const inp_kode_identitas = document.getElementById("kode_identitas");
const simbolAdmin = "a";
const simbolGuru = "g";
const simbolSiswa = "a";

role.addEventListener("change",() => {
    inp_kode_identitas.value = generateKode(role.value);
});



function generateKode(role){
    var number_code = "0000";
    var new_code = String(Number(total.value) + 1).padStart(number_code.length,"0");

    var choice_simbol = "s";
    if (role == "a"){
        choice_simbol = "a";
    }else if (role == "g"){
        choice_simbol = "g";
    }

    return choice_simbol + "-" + new_code;
}

function kembali(){
    window.location.href = "/";
}