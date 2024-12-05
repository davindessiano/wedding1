<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
        $_SESSION['admin'] = true;  
        header('Location: index.php');  
        exit();
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <!-- Link Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="text-center">
            <!-- Icon -->
            <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-500 text-white rounded-full mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 7a2 2 0 114 0 2 2 0 01-4 0zm2 8a5 5 0 00-4-2h8a5 5 0 00-4 2z" clip-rule="evenodd" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Login Admin</h2>
            <p class="text-gray-500">Selamat datang! Masukkan detail login Anda.</p>
        </div>
        <form action="login.php" method="POST" class="mt-6">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" 
                       class="mt-1 p-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500" 
                       placeholder="Masukkan username" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" 
                       class="mt-1 p-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500" 
                       placeholder="Masukkan password" required>
            </div>
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white py-2 px-4 rounded-lg font-semibold shadow-lg">
                Login
            </button>
        </form>
        <?php if (isset($error)): ?>
            <div class="mt-4 text-red-600 text-sm text-center"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="mt-4 text-center">
            <a href="#" class="text-purple-600 hover:text-purple-800 hover:underline font-medium">Lupa Password?</a>
        </div>
    </div>

</body>
</html>
