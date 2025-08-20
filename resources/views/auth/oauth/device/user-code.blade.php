<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Verifikasi Kode Perangkat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
        };
    </script>
</head>

<body
    class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-gray-800 dark:to-gray-900 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 space-y-6 text-center">
        <div class="flex justify-center">
            <div class="text-5xl text-blue-500 dark:text-blue-400">🔐</div>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Verifikasi Kode Perangkat</h1>

        <p class="text-sm text-gray-600 dark:text-gray-400">
            Masukkan <strong>kode pengguna</strong> yang muncul di perangkat Anda untuk menyambungkan perangkat ini
            dengan akun Anda.
        </p>

        <form method="GET" action="/oauth/device">
            @csrf
            <input type="text" name="user_code" placeholder="Contoh: GQKHSKHR"
                class="w-full px-5 py-3
                @error('user_code') border-red-500 dark:border-red-400 @else border-gray-300 dark:border-gray-600 @enderror
                text-center text-xl font-mono tracking-widest border rounded-lg focus:outline-none focus:ring-2 dark:bg-gray-700 dark:text-white" />

            @error('user_code')
                <p class="text-sm text-red-600 dark:text-red-400 text-left mt-1">{{ $message }}</p>
            @enderror

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200 mt-4">
                Verifikasi Kode
            </button>
        </form>

        <div class="text-xs text-gray-500 dark:text-gray-400 mt-4 space-y-1">
            <p>Kode berlaku selama 10 menit setelah dibuat.</p>
            <p>Pastikan Anda hanya memasukkan kode dari perangkat yang tepercaya.</p>
        </div>

        <hr class="border-gray-300 dark:border-gray-600">

        <div class="text-xs text-gray-400 dark:text-gray-500">
            Laravel Passport Device Flow · SSO Server
        </div>
    </div>

</body>

</html>
