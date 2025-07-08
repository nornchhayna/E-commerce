<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login to Your Account</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input name="email" type="email" required placeholder="you@example.com"
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:outline-none" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input name="password" type="password" required placeholder="••••••••"
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:outline-none" />
            </div>

            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-xl hover:bg-blue-600 transition duration-200">
                Login
            </button>
        </form>

        <p class="text-sm text-center mt-6 text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a>
        </p>
    </div>

</body>

</html>