<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard SSO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
        }

        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.querySelector('#dropdownButton');
            const dropdownMenu = document.querySelector('#dropdownMenu');

            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown if clicked outside
            window.addEventListener('click', function(e) {
                if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 min-h-screen text-gray-800 dark:text-gray-100">
    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Dashboard SSO</h1>
            <div class="relative">
                <button id="dropdownButton"
                    class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    <!-- Foto Profil -->
                    <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}" alt="User Avatar"
                        class="w-8 h-8 rounded-full">
                    <span>{{ auth()->user()->name }}</span>
                </button>
                <!-- Dropdown Menu -->
                <div id="dropdownMenu"
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-lg py-2 hidden z-50">
                    <!-- Bagian Nama dan Foto User -->
                    <div class="flex items-center px-4 py-2 space-x-2">
                        <!-- Foto Profil -->
                        <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}" alt="User Avatar"
                            class="w-10 h-10 rounded-full">
                        <!-- Nama User -->
                        <span
                            class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</span>
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-700"></div>
                    <!-- Menu Logout -->
                    <a href="{{ route('logout') }}"
                        class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Logout
                    </a>
                    @if (auth()->user()?->role === 'admin')
                        <a href="/admin/dashboard"
                            class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Admin Dashboard
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card Aplikasi Admin dan User -->
            @if (auth()->user()->role === 'admin')
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 flex flex-col justify-between transition transform hover:scale-105 hover:shadow-xl">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Aplikasi Admin</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Pengelolaan aplikasi untuk Admin.
                        </p>
                    </div>
                    <div class="mt-4">
                        <a href="/admin/manage"
                            class="inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                            Buka Aplikasi Admin
                        </a>
                    </div>
                </div>
            @endif

            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 flex flex-col justify-between transition transform hover:scale-105 hover:shadow-xl">
                <div>
                    <h2 class="text-lg font-semibold mb-2">Aplikasi Satu</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Aplikasi yang bisa diakses oleh semua pengguna.
                    </p>
                </div>
                <div class="mt-4">
                    <a href="http://localhost:8001/sso/login" target="_blank"
                        class="inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        Buka Aplikasi
                    </a>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 flex flex-col justify-between transition transform hover:scale-105 hover:shadow-xl">
                <div>
                    <h2 class="text-lg font-semibold mb-2">Aplikasi Dua</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Aplikasi yang hanya bisa diakses oleh pengguna tertentu.
                    </p>
                </div>
                <div class="mt-4">
                    <a href="/apps/absensi"
                        class="inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        Buka Aplikasi
                    </a>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 flex flex-col justify-between transition transform hover:scale-105 hover:shadow-xl">
                <div>
                    <h2 class="text-lg font-semibold mb-2">Aplikasi Tiga</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Aplikasi yang tersedia untuk semua pengguna.
                    </p>
                </div>
                <div class="mt-4">
                    <a href="/apps/keuangan"
                        class="inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        Buka Aplikasi
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
