<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-black relative">

    <!-- BACKGROUND IMAGE -->
    <img src="/images/gallery2.webp" 
         class="absolute inset-0 w-full h-full object-cover opacity-70">

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- LOGIN CARD -->
    <div class="relative z-10 backdrop-blur-md bg-white/10 border border-white/20 shadow-2xl rounded-2xl p-8 w-96 text-white">

        <h2 class="text-2xl font-semibold text-center mb-6 tracking-wide">
            Admin Login
        </h2>

        <?php if(session('error')): ?>
            <p class="text-red-400 text-sm mb-3 text-center">
                <?php echo e(session('error')); ?>

            </p>
        <?php endif; ?>

        <form method="POST" action="/admin/login">
            <?php echo csrf_field(); ?>

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="text-sm">Email</label>
                <input type="email" name="email" required
                    class="w-full mt-1 p-2 rounded bg-white/20 border border-white/30 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    placeholder="admin@email.com">
            </div>

            <!-- PASSWORD -->
            <div class="mb-6">
                <label class="text-sm">Password</label>
                <input type="password" name="password" required
                    class="w-full mt-1 p-2 rounded bg-white/20 border border-white/30 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    placeholder="********">
            </div>

            <!-- BUTTON -->
            <button
                class="w-full bg-yellow-600 hover:bg-yellow-700 transition py-2 rounded font-semibold tracking-wide">
                LOGIN
            </button>

            <div class="mt-4 text-center">
                <a href="<?php echo e(route('home')); ?>" class="text-sm text-gray-300 hover:text-white transition">
                    ← Kembali ke Home
                </a>
            </div>
        </form>

        <!-- FOOTER TEXT -->
        <p class="text-xs text-center text-gray-300 mt-6">
            © 2026 BUKYUK VILLA
        </p>

    </div>

</body>
</html><?php /**PATH C:\laragon\www\proyek\resources\views/admin/login.blade.php ENDPATH**/ ?>