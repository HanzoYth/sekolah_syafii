<link rel="stylesheet" href="{{asset('css/component/warning.css')}}">
<div>
    @if(session('eror'))
        <div class="alert alert-danger" id="errorToast">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                <div>
                    <p>
                        <i class="fas fa-exclamation-circle" style="color: #e63946;"></i> 
                        {{ session('eror') }}
                    </p>
                </div>
                <button type="button" onclick="closeToast()" style="background:none; border:none; color: var(--text-light); cursor:pointer; font-size:1.1rem; line-height:1;">&times;</button>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" id="errorToast">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                <div>
                    @foreach ($errors->all() as $error)
                        <p>
                            <i class="fas fa-exclamation-circle" style="color: #e63946;"></i> 
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
                <button type="button" onclick="closeToast()" style="background:none; border:none; color: var(--text-light); cursor:pointer; font-size:1.1rem; line-height:1;">&times;</button>
            </div>
        </div>
    @endif
</div>
<script>
        function closeToast() {
            const toast = document.getElementById('errorToast');
            if (toast) {
                toast.classList.add('fade-out');
                setTimeout(() => {
                    toast.remove();
                }, 400); // Sesuai durasi animasi slideOutRight
            }
        }

        // Otomatis hilangkan error setelah 5 detik
        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('errorToast');
            if (toast) {
                setTimeout(() => {
                    closeToast();
                }, 5000); // 5000ms = 5 detik
            }
        });
        function switchTab(type) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const tabLoginBtn = document.getElementById('tabLoginBtn');
            const tabRegisterBtn = document.getElementById('tabRegisterBtn');

            if (type === 'login') {
                loginForm.classList.add('active');
                registerForm.classList.remove('active');
                tabLoginBtn.classList.add('active');
                tabRegisterBtn.classList.remove('active');
            } else {
                registerForm.classList.add('active');
                loginForm.classList.remove('active');
                tabRegisterBtn.classList.add('active');
                tabLoginBtn.classList.remove('active');
            }
        }
</script>