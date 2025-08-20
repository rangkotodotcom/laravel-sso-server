<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Authorize Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
        }
    </script>
</head>

<body
    class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full space-y-6">
        <div class="text-center">
            <div class="text-blue-500 text-5xl mb-3">🔐</div>
            <h1 class="text-2xl font-bold">Authorize Application</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                Konfirmasi untuk memberikan akses ke aplikasi berikut.
            </p>
        </div>

        <div class="bg-gray-100 dark:bg-gray-800 p-5 rounded-lg shadow space-y-4">
            <p class="text-base">
                <strong>{{ $client->name }}</strong> ingin mengakses akun Anda.
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Aplikasi ini akan dapat mengakses data Anda sesuai izin yang diberikan.
            </p>

            <form method="post" action="{{ route('passport.authorizations.approve') }}">
                @csrf
                <input type="hidden" name="state" value="{{ request('state') }}" />
                <input type="hidden" name="client_id" value="{{ $client->id }}" />
                <input type="hidden" name="auth_token" value="{{ $authToken }}" />

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded transition">
                    Authorize
                </button>
            </form>

            <form method="post" action="{{ route('passport.authorizations.deny') }}">
                @method('delete')
                @csrf
                <input type="hidden" name="state" value="{{ request('state') }}" />
                <input type="hidden" name="client_id" value="{{ $client->id }}" />
                <input type="hidden" name="auth_token" value="{{ $authToken }}" />

                <button type="submit"
                    class="w-full bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-100 hover:bg-gray-400 dark:hover:bg-gray-600 font-medium py-2 rounded transition">
                    Cancel
                </button>
            </form>
        </div>

        <div class="text-center text-xs text-gray-500 dark:text-gray-400">
            Powered by Laravel Passport
        </div>
    </div>
</body>

</html>
