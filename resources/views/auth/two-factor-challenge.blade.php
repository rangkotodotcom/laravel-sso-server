<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verifikasi 2FA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
        }
    </script>
</head>

<body
    class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full space-y-6" role="main" aria-label="Halaman two factor authentication">
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
            <!-- Icon & Heading -->
            <div class="text-center">
                <div class="text-blue-400 text-5xl mb-3">📲</div>
                <h1 class="text-2xl font-bold">Autentikasi Dua Faktor</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Masukkan kode autentikasi dari aplikasi authenticator kamu atau gunakan recovery code.
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('two-factor.login.store') }}" class="space-y-4">
                @csrf

                <!-- Code -->
                <div>
                    <label for="code" class="block text-sm font-medium mb-1">Kode Autentikasi</label>
                    <input type="text" name="code" id="code" inputmode="numeric" autocomplete="one-time-code"
                        class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('code')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center text-sm text-gray-500 dark:text-gray-400">atau</div>

                <!-- Recovery Code -->
                <div>
                    <label for="recovery_code" class="block text-sm font-medium mb-1">Recovery Code</label>
                    <input type="text" name="recovery_code" id="recovery_code"
                        class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('recovery_code')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded transition">
                    Verifikasi
                </button>
            </form>

            <!-- Back to Login -->
            <div class="text-center text-sm text-gray-500 dark:text-gray-400">
                Salah akun?
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-red-600 hover:underline">Logout</a>

                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>
            </div>
        </div>

        <div class="text-center text-xs text-gray-500 dark:text-gray-400 mt-4">
            Powered by Laravel Passport
        </div>
    </div>
</body>

</html>
