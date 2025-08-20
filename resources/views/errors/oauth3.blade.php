<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kesalahan Otorisasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
        }
    </script>
</head>

<body
    class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-lg w-full space-y-6 text-center">
        <div class="text-6xl text-yellow-500">⚠️</div>
        <h1 class="text-2xl font-bold">Terjadi Kesalahan Saat Proses Login</h1>

        <div class="bg-gray-100 dark:bg-gray-800 p-5 rounded-lg text-left shadow space-y-4">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Maaf, kami tidak dapat memproses permintaan login Anda. Silakan coba kembali nanti atau hubungi penyedia
                aplikasi jika masalah terus terjadi.
            </p>

            @if (!empty($error['error']))
                <details class="mt-4">
                    <summary class="cursor-pointer text-sm text-blue-600 dark:text-blue-400 underline">Tampilkan info
                        teknis (untuk developer)</summary>
                    <div
                        class="mt-2 space-y-2 text-xs text-gray-600 dark:text-gray-400 bg-gray-200 dark:bg-gray-700 p-3 rounded">
                        <div><strong>Error:</strong> {{ $error['error'] }}</div>

                        @if (!empty($error['error_description']))
                            <div><strong>Deskripsi:</strong> {{ $error['error_description'] }}</div>
                        @endif

                        @if (!empty($error['hint']))
                            <div><strong>Petunjuk:</strong> {{ $error['hint'] }}</div>
                        @endif
                    </div>
                </details>
            @endif
        </div>

        <div class="space-y-2">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Jika Anda pengembang dan membutuhkan bantuan, silakan <a href="/docs/oauth" class="underline">baca
                    dokumentasi OAuth</a> atau <a href="/support" class="underline">hubungi tim teknis</a>.
            </p>
            @if (auth()->check())
                <a href="/"
                    class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                    Kembali ke Beranda
                </a>
            @else
                <a href="{{ route('logout') }}"
                    class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                    Login Ulang
                </a>
            @endif
        </div>
    </div>
</body>

</html>
