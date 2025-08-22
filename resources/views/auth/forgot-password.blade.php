<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Kata Sandi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
        }
    </script>
</head>

<body
    class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full space-y-6" role="main" aria-label="Halaman lupa kata sandi">
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
            <!-- Heading -->
            <div class="text-center">
                <div class="text-yellow-500 text-5xl mb-3">🔒</div>
                <h1 class="text-2xl font-bold">Lupa Kata Sandi?</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Masukkan email kamu dan kami akan mengirimkan link untuk mereset kata sandi.
                </p>
            </div>

            <!-- Status Message -->
            @if (session('status'))
                <div
                    class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-sm rounded px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 rounded border @error('email') border-red-500 dark:border-red-400 @else border-gray-300 dark:border-gray-700 @enderror bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                    @error('email')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 rounded transition">
                    Kirim Link Reset
                </button>
            </form>

            <!-- Back to Login -->
            <div class="text-center text-sm text-gray-500 dark:text-gray-400">
                Ingat kata sandi kamu?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Kembali ke Login</a>
            </div>
        </div>

        <div class="text-center text-xs text-gray-500 dark:text-gray-400 mt-4">
            Powered by Laravel Passport
        </div>
    </div>
</body>

</html>
