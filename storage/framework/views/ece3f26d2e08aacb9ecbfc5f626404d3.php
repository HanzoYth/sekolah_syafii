<link rel="stylesheet" href="<?php echo e(asset('css/component/warning.css')); ?>?v=<?php echo e(time()); ?>">
<div>
    <?php if(session('eror') || session('error')): ?>
        <div class="alert alert-danger" id="errorToast">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                <div>
                    <p>
                        <i class="fas fa-exclamation-circle" style="color: #e63946;"></i> 
                        <?php echo e(session('eror') ?? session('error')); ?>

                    </p>
                </div>
                <button type="button" onclick="closeToast()" style="background:none; border:none; color: var(--text-light); cursor:pointer; font-size:1.1rem; line-height:1;">&times;</button>
            </div>
        </div>
    <?php elseif(session('success')): ?>
        <div class="alert alert-danger" id="errorToast">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                <div>
                    <p>
                        <i class="fas fa-check-circle" style="color: #39e64d;"></i> 
                        <?php echo e(session('success')); ?>

                    </p>
                </div>
                <button type="button" onclick="closeToast()" style="background:none; border:none; color: var(--text-light); cursor:pointer; font-size:1.1rem; line-height:1;">&times;</button>
            </div>
        </div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger" id="errorToast">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                <div>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p>
                            <i class="fas fa-exclamation-circle" style="color: #e63946;"></i> 
                            <?php echo e($error); ?>

                        </p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <button type="button" onclick="closeToast()" style="background:none; border:none; color: var(--text-light); cursor:pointer; font-size:1.1rem; line-height:1;">&times;</button>
            </div>
        </div>
    <?php endif; ?>
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
</script><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/warning.blade.php ENDPATH**/ ?>