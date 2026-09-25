const role = document.getElementById("role_type");
const total = document.getElementById("total");
const inp_kode_identitas = document.getElementById("kode_identitas");
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
    }else if (role == "y"){
        choice_simbol = "y";
    }else if (role == "b"){
        choice_simbol = "b";
    }else if (role == "o"){
        choice_simbol = "o";
    }else{
        choice_simbol = "p";
    }

    return choice_simbol + "-" + new_code;
}

function kembali(){
    window.location.href = "/";
}

/* ================= TAMBAHAN: DAFTAR KODE PER ROLE ================= */

const roleTabButtons = document.querySelectorAll(".role-tab-btn");
const dataListWrapper = document.getElementById("data-list-wrapper");
const dataListBody = document.getElementById("data-list-body");
const emptyStateText = document.getElementById("empty-state-text");

// Menyimpan role yang sedang aktif supaya bisa dipakai lagi
// setelah proses hapus (untuk reload daftar).
let currentActiveRole = null;

roleTabButtons.forEach(btn => {
    btn.addEventListener("click", () => {
        roleTabButtons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        currentActiveRole = btn.dataset.role;
        muatDaftarKode(btn.dataset.role);
    });
});

function muatDaftarKode(role){
    currentActiveRole = role;

    fetch(`/ab/idnt/${role}`)
        .then(res => {
            if (!res.ok) throw new Error("Gagal mengambil data");
            return res.json();
        })
        .then(data => {
            dataListBody.innerHTML = "";

            if (!data || data.length === 0) {
                dataListWrapper.classList.add("hide");
                emptyStateText.textContent = "Belum ada data untuk role ini.";
                emptyStateText.classList.remove("hide");
                return;
            }

            emptyStateText.classList.add("hide");
            dataListWrapper.classList.remove("hide");

            data.forEach(item => {
                const tr = document.createElement("tr");
                const sudahDipakai = item.aktif == 1;
                tr.innerHTML = `
                    <td>${item.identitas}</td>
                    <td>
                        <span class="status-badge ${sudahDipakai ? 'used' : 'unused'}">
                            ${sudahDipakai ? 'Sudah Dipakai' : 'Belum Dipakai'}
                        </span>
                    </td>
                    <td>
                        <button type="button" class="btn-hapus-kode" data-id="${item.id}">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </td>
                `;
                dataListBody.appendChild(tr);
            });
        })
        .catch(err => {
            console.error(err);
            dataListWrapper.classList.add("hide");
            emptyStateText.textContent = "Terjadi kesalahan saat mengambil data.";
            emptyStateText.classList.remove("hide");
        });
}

/* ================= TAMBAHAN: HAPUS KODE ================= */

// Event delegation: tombol hapus dibuat dinamis lewat innerHTML,
// jadi listener dipasang di parent (dataListBody), bukan per tombol.
dataListBody.addEventListener("click", (e) => {
    const btn = e.target.closest(".btn-hapus-kode");
    if (!btn) return;

    const id = btn.dataset.id;
    if (!confirm("Yakin ingin menghapus kode ini?")) return;

    hapusKode(id);
});

function hapusKode(id){
    window.location.href = `/hpidnt/${id}`;
}