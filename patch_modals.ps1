$cssFile = "public\css\modul\siakad\tambahKelas.css"
$cssAdd = @"

/* MODAL & TOAST STYLES */
.custom-modal-overlay {
    position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(24, 51, 44, 0.6);
    transition: all 0.3s ease;
    padding: 20px;
    opacity: 0; visibility: hidden;
    display: flex; align-items: center; justify-content: center;
    z-index: 9999;
}
.custom-modal-overlay.active {
    opacity: 1; visibility: visible;
}
.custom-modal-card {
    background: #fff;
    width: 100%; max-width: 440px;
    border-radius: 16px;
    padding: 24px;
    border: 1px solid #dce8e1;
    font-family: 'Poppins', sans-serif;
    transform: scale(0.95);
    transition: transform 0.3s ease;
}
.custom-modal-overlay.active .custom-modal-card {
    transform: scale(1);
}
.modal-header-icon {
    width: 60px; height: 60px;
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 24px;
    margin-bottom: 20px;
}
.icon-edit { background: #e9f2ff; color: #3875c5; }
.icon-delete { background: #f8e9e9; color: #b34d4d; }
.custom-modal-card h3 { margin: 0 0 10px; font-size: 1.25rem; color: #1f2937; }
.custom-modal-card p { margin: 0 0 24px; color: #6b7280; font-size: 0.88rem; line-height: 1.5; }
.custom-input { width: 100%; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-family: inherit; font-size: 0.95rem; margin-bottom: 24px; outline: none; transition: border-color 0.2s; }
.custom-input:focus { border-color: #3875c5; box-shadow: 0 0 0 3px rgba(56, 117, 197, 0.1); }
.modal-actions { display: flex; gap: 12px; }
.btn-modal { flex: 1; padding: 12px; border-radius: 10px; border: none; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.2s; }
.btn-cancel { background: #f3f4f6; color: #4b5563; }
.btn-cancel:hover { background: #e5e7eb; }
.btn-confirm-edit { background: #3875c5; color: #fff; }
.btn-confirm-edit:hover { background: #2563eb; }
.btn-confirm-delete { background: #b34d4d; color: #fff; }
.btn-confirm-delete:hover { background: #963d3d; }

.alert-toast {
    padding: 16px 20px; background: #ecfdf5; color: #065f46;
    border-radius: 12px; border: 1px solid #a7f3d0;
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 24px; font-weight: 500; font-size: 0.95rem;
}
.alert-toast.error {
    background: #fef2f2; color: #991b1b; border: 1px solid #fecaca;
}
"@
Add-Content -Path $cssFile -Value $cssAdd
Write-Host "CSS Updated"

$bladeFile = "resources\views\modul\siakad\admin\tambahKelas.blade.php"
$bladeContent = Get-Content $bladeFile -Raw

# 1. Fix Regex Artifact
$bladeContent = $bladeContent -replace '\$13" style="text-align: center; color: #6b7b75; padding: 30px;">', '<td colspan="3" style="text-align: center; color: #6b7b75; padding: 30px;">'

# 2. Add Toasts
$toastHtml = @"
                <div class="content-body">
                    @if(session('success'))
                    <div class="alert-toast">
                        <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert-toast error">
                        <i class="fa-solid fa-circle-exclamation" style="font-size: 1.2rem;"></i>
                        {{ session('error') }}
                    </div>
                    @endif
"@
$bladeContent = $bladeContent -replace '(<div class="content-body">)', $toastHtml

# 3. Replace Edit Link with Button
$editRegex = '(?s)<a href="/sk/edit-kelas/\{\{ \$k->id \}\}" class="btn-action edit" style="(.*?)".*?>\s*<i class="fa-solid fa-pen-to-square"></i>\s*</a>'
$editReplacement = '<button type="button" class="btn-action edit" style="$1 cursor: pointer;" title="Edit" onclick="openEditModal({{ $k->id }}, ''{{ $k->nama_kelas }}'')"><i class="fa-solid fa-pen-to-square"></i></button>'
$bladeContent = [regex]::Replace($bladeContent, $editRegex, $editReplacement)

# 4. Replace Delete Link with Button
$delRegex = '(?s)<a href="/sk/hapus-kelas/\{\{ \$k->id \}\}" class="btn-action delete" style="(.*?)".*?>\s*<i class="fa-solid fa-trash-can"></i>\s*</a>'
$delReplacement = '<button type="button" class="btn-action delete" style="$1 cursor: pointer;" title="Hapus" onclick="openDeleteModal({{ $k->id }}, ''{{ $k->nama_kelas }}'')"><i class="fa-solid fa-trash-can"></i></button>'
$bladeContent = [regex]::Replace($bladeContent, $delRegex, $delReplacement)

# 5. Append Modals and JS
$modalsAndJs = @"

    <!-- MODAL EDIT -->
    <div class="custom-modal-overlay" id="editModal">
        <div class="custom-modal-card">
            <div class="modal-header-icon icon-edit">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <h3>Edit Ruang Kelas</h3>
            <form id="editForm" method="POST">
                @csrf
                <input type="text" name="nama_kelas" id="editInput" class="custom-input" required autocomplete="off">
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                    <button type="submit" class="btn-modal btn-confirm-edit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL HAPUS -->
    <div class="custom-modal-overlay" id="deleteModal">
        <div class="custom-modal-card" style="text-align: center;">
            <div class="modal-header-icon icon-delete" style="margin: 0 auto 20px;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3>Konfirmasi Hapus</h3>
            <p>Anda yakin ingin menghapus kelas <strong><span id="deleteClassName"></span></strong>? Data yang dihapus tidak dapat dipulihkan.</p>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-cancel" onclick="closeAllModals()">Batal</button>
                <button type="button" class="btn-modal btn-confirm-delete" id="btnConfirmDelete">Ya, Hapus Data</button>
            </div>
        </div>
    </div>

    <script>
        const overlayEdit = document.getElementById('editModal');
        const overlayDelete = document.getElementById('deleteModal');
        
        const editForm = document.getElementById('editForm');
        const editInput = document.getElementById('editInput');
        const btnConfirmDelete = document.getElementById('btnConfirmDelete');
        const deleteClassName = document.getElementById('deleteClassName');
        let deleteIdTarget = null;

        function closeAllModals() {
            if(overlayEdit) overlayEdit.classList.remove('active');
            if(overlayDelete) overlayDelete.classList.remove('active');
        }

        function openEditModal(id, nama) {
            closeAllModals();
            editForm.action = "/sk/update-kelas/" + id;
            editInput.value = nama;
            overlayEdit.classList.add('active');
        }

        function openDeleteModal(id, nama) {
            closeAllModals();
            deleteIdTarget = id;
            deleteClassName.textContent = nama;
            overlayDelete.classList.add('active');
        }

        if(btnConfirmDelete) {
            btnConfirmDelete.addEventListener('click', function() {
                if (deleteIdTarget) {
                    window.location.href = "/sk/hapus-kelas/" + deleteIdTarget;
                }
            });
        }

        // Close on overlay click
        [overlayEdit, overlayDelete].forEach(modal => {
            if(modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) closeAllModals();
                });
            }
        });
    </script>
"@

$bladeContent = $bladeContent -replace '(?s)(<script>\s*const jenjang = document.getElementById)', ($modalsAndJs + "`n`n`$1")

Set-Content $bladeFile $bladeContent -NoNewline
Remove-Item -Path "storage\framework\views\*.php" -Force -ErrorAction SilentlyContinue
Write-Host "Blade Updated"
