const inp_nama = document.getElementById("nama");
const inp_tanggal = document.getElementById("tanggal");
const inp_status = document.getElementById("status");
const btn_tmpl = document.getElementById("tampilkan");
const btn_reset = document.getElementById("reset");
const data = document.querySelectorAll(".attendance-card");


function filterData(nama,tanggal,status){
    data.forEach((item) => {
        if (nama != "" && tanggal != "" && status != ""){
            if (item.querySelector(".details h5").textContent.toLowerCase().includes(nama) && item.querySelector(".tanggal").dataset.tanggal === tanggal && item.querySelector(".status-tag").dataset.sts == status){
                item.classList.remove("hide");
            }else{
                item.classList.add("hide");
            }
        }else{
            if (nama != ""){
                if (tanggal != ""){
                    if (item.querySelector(".details h5").textContent.toLowerCase().includes(nama) && item.querySelector(".tanggal").dataset.tanggal == tanggal){
                        item.classList.remove("hide");
                    }else{
                        item.classList.add("hide")
                    }
                }else if (status != ""){
                    if (item.querySelector(".details h5").textContent.toLowerCase().includes(nama) && item.querySelector(".status-tag").dataset.sts == status){
                        item.classList.remove("hide");
                    }else{
                        item.classList.add("hide")
                    }
                }else{
                    if (item.querySelector(".details h5").textContent.toLowerCase().includes(nama)){
                        item.classList.remove("hide");
                    }else{
                        item.classList.add("hide")
                    }                
                }

            }
            if (tanggal != ""){
                if (nama != ""){
                    if (item.querySelector(".details h5").textContent.toLowerCase().includes(nama) && item.querySelector(".tanggal").dataset.tanggal == tanggal){
                        item.classList.remove("hide");
                    }else{
                        item.classList.add("hide")
                    }
                }else if (status != ""){
                    if (item.querySelector(".tanggal").dataset.tanggal == tanggal && item.querySelector(".status-tag").dataset.sts == status){
                        item.classList.remove("hide");
                    }else{
                        item.classList.add("hide")
                    }
                }else{
                    if (item.querySelector(".tanggal").dataset.tanggal == tanggal){
                        item.classList.remove("hide");
                    }else{
                        item.classList.add("hide")
                    }                
                }
            }
            if (status != ""){
                if (nama != ""){
                    if (item.querySelector(".details h5").textContent.toLowerCase().includes(nama) && item.querySelector(".status-tag").dataset.sts == status){
                        item.classList.remove("hide");
                    }else{
                        item.classList.add("hide")
                    }
                }else if (tanggal != ""){
                    if (item.querySelector(".tanggal").dataset.tanggal == tanggal && item.querySelector(".status-tag").dataset.sts == status){
                        item.classList.remove("hide");
                    }else{
                        item.classList.add("hide")
                    }
                }else{
                    if (item.querySelector(".status-tag").dataset.sts == status){
                        item.classList.remove("hide");
                    }else{
                        item.classList.add("hide")
                    }                
                }
            }
        }

    });
    return;
}

function reset(){
    inp_nama.value = "";
    inp_status.value = "";
    inp_tanggal.value = "";

    data.forEach((item) => {
        item.classList.remove("hide");
    });
}

btn_tmpl.addEventListener('click',() => {
    filterData(inp_nama.value,inp_tanggal.value,inp_status.value);
});

btn_reset.addEventListener('click',() => {
    reset();
});