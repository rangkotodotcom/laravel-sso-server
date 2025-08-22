@extends('layout.home.main')

@section('title', 'Dashboard')

@section('container')
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
@endsection
