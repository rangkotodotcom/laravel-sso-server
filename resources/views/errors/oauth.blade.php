<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OAuth Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body
    class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="max-w-xl w-full text-center space-y-6">
        <div class="text-6xl text-red-600 dark:text-red-400">⚠️</div>
        <h1 class="text-2xl font-semibold">Permintaan OAuth Tidak Valid</h1>
        <p class="text-gray-600 dark:text-gray-300">
            Server menerima permintaan OAuth yang tidak lengkap. Pastikan parameter yang dibutuhkan telah dikirim dengan
            benar.
        </p>

        <div
            class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4 text-left text-sm text-gray-700 dark:text-gray-200 shadow-inner">
            <p class="mb-2 font-medium">Detail Kesalahan:</p>
            <ul class="list-disc list-inside space-y-1">
                <li><code class="bg-gray-200 dark:bg-gray-700 px-1 py-0.5 rounded text-sm">client_id</code> tidak
                    ditemukan</li>
                <li><code class="bg-gray-200 dark:bg-gray-700 px-1 py-0.5 rounded text-sm">redirect_uri</code> tidak
                    disediakan</li>
            </ul>
            <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                Permintaan OAuth harus menyertakan parameter <code>client_id</code> dan <code>redirect_uri</code> yang
                valid.
            </p>
        </div>

        <a href="/" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
            Kembali ke Beranda
        </a>
    </div>
</body>

</html>
