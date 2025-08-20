<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Izinkan Akses Perangkat - {{ $client->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full space-y-6" role="main" aria-label="Halaman otorisasi perangkat">
        <div class="max-w-md w-full bg-white dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
            <div class="text-center">
                <div class="text-blue-500 text-5xl mb-3" aria-hidden="true">🔐</div>
                <h1 class="text-2xl font-bold">Izinkan Akses Perangkat</h1>
                <p>Anda sedang diminta untuk memberikan akses perangkat <strong>{{ $client->name }}</strong>.</p>
            </div>

            <!-- Pesan error / info -->
            @if (session('error'))
                <div class="bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-300 p-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('info'))
                <div class="bg-blue-100 text-blue-700 dark:bg-blue-800 dark:text-blue-300 p-3 rounded">
                    {{ session('info') }}
                </div>
            @endif

            <!-- Informasi tambahan -->
            <div class="bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-300 p-4 rounded-lg shadow">
                <strong>⚠️ Perhatian:</strong> Pastikan Anda hanya memberikan akses ke perangkat yang Anda percaya.
                Data Anda akan diakses sesuai izin yang diberikan dan berlaku selama
                <strong>{{ now()->diffForHumans(now()->add(\Laravel\Passport\Passport::tokensExpireIn()), true) }}</strong>.
                Jika Anda login ulang menggunakan token ini, akses dapat bertahan hingga
                <strong>{{ now()->diffForHumans(now()->add(\Laravel\Passport\Passport::refreshTokensExpireIn()), true) }}</strong>.
            </div>

            <p class="text-base">
                <strong>{{ $client->name }}</strong> ingin mengakses akun Anda dengan izin berikut:
            </p>

            <!-- Daftar Scope dengan deskripsi tambahan -->
            <ul class="list-disc list-inside text-sm text-gray-700 dark:text-gray-300 space-y-2"
                aria-label="Daftar izin yang diminta perangkat">
                @foreach ($scopes as $scope)
                    <li>
                        <strong>{{ $scope->description }}</strong>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">
                            {{-- Contoh penjelasan sederhana, sesuaikan dengan scope nyata --}}
                            @if ($scope->id === 'profile')
                                Akses informasi dasar seperti nama, alamat email, dan foto profil Anda.
                            @elseif ($scope->id === 'email')
                                Akses alamat email Anda yang terdaftar.
                            @else
                                Izin terkait akses data lainnya yang diperlukan perangkat.
                            @endif
                        </p>
                    </li>
                @endforeach
            </ul>

            <div class="flex gap-4 mt-4">
                <!-- Form Authorize -->
                <form method="post" action="{{ route('passport.authorizations.approve') }}" class="flex-1"
                    aria-label="Form untuk mengizinkan perangkat">
                    @csrf
                    <input type="hidden" name="state" value="{{ request('state') }}" />
                    <input type="hidden" name="client_id" value="{{ $client->id }}" />
                    <input type="hidden" name="auth_token" value="{{ $authToken }}" />

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg shadow transition duration-200"
                        aria-label="Tombol izinkan akses perangkat">
                        Izinkan
                    </button>
                </form>

                <!-- Form Deny -->
                <form method="post" action="{{ route('passport.authorizations.deny') }}" class="flex-1"
                    aria-label="Form untuk menolak akses perangkat">
                    @method('delete')
                    @csrf
                    <input type="hidden" name="state" value="{{ request('state') }}" />
                    <input type="hidden" name="client_id" value="{{ $client->id }}" />
                    <input type="hidden" name="auth_token" value="{{ $authToken }}" />

                    <button type="submit"
                        class="w-full border border-red-400 dark:border-red-600 bg-transparent text-gray-700 dark:text-gray-200 hover:bg-red-100 dark:hover:bg-red-700 font-medium py-2 rounded-lg transition duration-200"
                        aria-label="Tombol batalkan akses perangkat">
                        Batal
                    </button>
                </form>
            </div>

            <!-- Link kebijakan privasi dan kontak developer -->
            <div class="mt-6 text-xs text-gray-600 dark:text-gray-400 space-y-1">
                <p>
                    <strong>Kebijakan Privasi:</strong> <a href="https://example.com/privacy" target="_blank"
                        rel="noopener noreferrer" class="text-blue-600 hover:underline">Lihat di sini</a>
                </p>
                <p>
                    <strong>Kontak Developer:</strong> <a href="mailto:support@example.com"
                        class="text-blue-600 hover:underline">support@example.com</a>
                </p>
            </div>
        </div>

        <div class="text-center text-xs text-gray-500 dark:text-gray-400 mt-4">
            Powered by Laravel Passport
        </div>
    </div>

    <!-- Optional Loading State (JavaScript) -->
    <script>
        const forms = document.querySelectorAll("form");
        forms.forEach(form => {
            form.addEventListener("submit", () => {
                const button = form.querySelector("button");
                button.disabled = true;
                button.innerText = "Memproses...";
            });
        });
    </script>
</body>

</html>
