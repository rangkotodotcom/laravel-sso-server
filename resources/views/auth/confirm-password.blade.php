<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konfirmasi Kata Sandi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
        }
    </script>
</head>

<body
    class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full space-y-6" role="main" aria-label="Halaman konfirmasi kata sandi">
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
            <!-- Icon & Heading -->
            <div class="text-center">
                <div class="text-purple-500 text-5xl mb-3">🔐</div>
                <h1 class="text-2xl font-bold">Konfirmasi Kata Sandi</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Harap masukkan kata sandi kamu untuk melanjutkan.
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                @csrf

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium mb-1">Kata Sandi</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-2 rounded border @error('password') border-red-500 dark:border-red-400 @else border-gray-300 dark:border-gray-700 @enderror bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                    @error('password')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 rounded transition">
                    Konfirmasi
                </button>
            </form>

            <!-- Forgot Password Link -->
            <div class="text-center text-sm text-gray-500 dark:text-gray-400">
                Lupa kata sandi?
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Reset di sini</a>
            </div>
        </div>

        <div class="text-center text-xs text-gray-500 dark:text-gray-400 mt-4">
            Powered by Laravel Passport
        </div>
    </div>
</body>

</html>
