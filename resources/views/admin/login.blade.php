<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <form method="POST" action="/admin/login" class="bg-white p-8 rounded shadow w-80">
        @csrf

        <h2 class="text-xl font-bold mb-6 text-center">Admin Login</h2>

        @if(session('error'))
            <p class="text-red-500 text-sm mb-3">{{ session('error') }}</p>
        @endif

        <input type="email" name="email" placeholder="Email"
            class="w-full border p-2 mb-3 rounded">

        <input type="password" name="password" placeholder="Password"
            class="w-full border p-2 mb-4 rounded">

        <button class="w-full bg-yellow-600 text-white py-2 rounded">
            Login
        </button>
    </form>

</body>
</html>