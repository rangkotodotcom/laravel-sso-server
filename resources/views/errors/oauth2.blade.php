<!DOCTYPE html>
<html lang="en">

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
</head>

<body
    class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-lg w-full space-y-6 text-center">
        <div class="text-6xl text-yellow-500">⚠️</div>
        <h1 class="text-2xl font-bold">OAuth Authorization Error</h1>

        <div class="bg-gray-100 dark:bg-gray-800 p-5 rounded-lg text-left shadow space-y-3">
            <div>
                <span class="font-semibold">Error:</span>
                <code class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded inline-block text-sm">
                    {{ $error['error'] ?? 'unknown_error' }}
                </code>
            </div>

            <div>
                <span class="font-semibold">Description:</span>
                <p class="text-sm mt-1 text-gray-700 dark:text-gray-300">
                    {{ $error['error_description'] ?? 'No description provided.' }}
                </p>
            </div>

            @if (!empty($error['hint']))
                <div>
                    <span class="font-semibold">Hint:</span>
                    <p class="text-sm mt-1 text-gray-700 dark:text-gray-400">
                        {{ $error['hint'] }}
                    </p>
                </div>
            @endif
        </div>

        <a href="/" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
            Back to Home
        </a>
    </div>
</body>

</html>
