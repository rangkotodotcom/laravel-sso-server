<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>403 - Akses Ditolak</title>
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
        <div class="text-6xl text-red-500">🚫</div>
        <h1 class="text-3xl font-bold">403 - Akses Ditolak</h1>

        <div class="bg-gray-100 dark:bg-gray-800 p-5 rounded-lg text-left shadow space-y-4">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Anda tidak memiliki izin untuk mengakses halaman atau sumber daya ini.
                Mungkin Anda mencoba membuka halaman yang dilindungi tanpa hak akses yang sesuai.
            </p>

            @if (!empty($exception) && !empty($exception->getMessage()))
                <details class="mt-4">
                    <summary class="cursor-pointer text-sm text-blue-600 dark:text-blue-400 underline">Tampilkan info
                        teknis</summary>
                    <div
                        class="mt-2 space-y-2 text-xs text-gray-600 dark:text-gray-400 bg-gray-200 dark:bg-gray-700 p-3 rounded">
                        <div><strong>Pesan:</strong> {{ $exception->getMessage() }}</div>
                    </div>
                </details>
            @endif
        </div>

        <div class="space-y-2">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Jika Anda yakin ini adalah kesalahan, silakan <a href="/support" class="underline">hubungi tim
                    teknis</a>.
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
