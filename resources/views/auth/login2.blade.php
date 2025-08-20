<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
        }
    </script>
</head>

<body
    class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md space-y-6">
        <div class="text-center">
            <div class="text-blue-500 text-5xl mb-3">🔑</div>
            <h1 class="text-2xl font-bold">Login to Your Account</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                Masuk untuk melanjutkan ke aplikasi.
            </p>
        </div>

        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow space-y-5">
            @if (session('failed'))
                <div class="text-sm text-white bg-red-100 dark:bg-red-900 px-4 py-2 rounded">
                    {{ session('failed') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" id="email" required autofocus
                        class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-blue-600 focus:ring-blue-500" />
                        Remember me
                    </label>
                    {{-- <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forgot Password?</a> --}}
                    <a href="/auth/forgot-password" class="text-blue-600 hover:underline">Forgot Password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded transition">
                    Login
                </button>
            </form>
        </div>

        <div class="text-center text-sm text-gray-500 dark:text-gray-400">
            Belum punya akun?
            {{-- <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar sekarang</a> --}}
            <a href="/auth/register" class="text-blue-600 hover:underline">Daftar sekarang</a>
        </div>
    </div>
</body>

</html>
