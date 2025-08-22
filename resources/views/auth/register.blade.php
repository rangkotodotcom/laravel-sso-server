@extends('layout.auth.main')

@section('title', 'Register')
@section('aria-label', 'Halaman register')

@section('container')
    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
        <!-- Heading -->
        <div class="text-center">
            <div class="text-green-500 text-5xl mb-3">📝</div>
            <h1 class="text-2xl font-bold">Buat Akun Baru</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                Silakan isi formulir untuk mendaftar
            </p>
        </div>

        <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 rounded border @error('name') border-red-500 dark:border-red-400 @else border-gray-300 dark:border-gray-700 @enderror bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500" />
                @error('name')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium mb-1">Alamat Email</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 rounded border @error('email') border-red-500 dark:border-red-400 @else border-gray-300 dark:border-gray-700 @enderror bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500" />
                @error('email')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium mb-1">Kata Sandi</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 rounded border @error('password') border-red-500 dark:border-red-400 @else border-gray-300 dark:border-gray-700 @enderror bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500" />
                @error('password')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-1">Konfirmasi Kata
                    Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500" />
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded transition">
                Daftar
            </button>

            <!-- Social Register -->
            <div class="mt-6 space-y-4">
                <p class="text-center text-gray-500 dark:text-gray-400">Atau daftar dengan</p>

                <div class="flex flex-col gap-3">
                    <!-- Google Register -->
                    <a href="{{ route('register.google') }}"
                        class="w-full flex items-center justify-center gap-3 py-2 rounded text-white font-semibold bg-red-600 hover:bg-red-700 transition">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#EA4335"
                                d="M23.49 12.276c0-.824-.074-1.615-.208-2.37H12v4.483h6.396c-.275 1.485-1.11 2.745-2.37 3.594v2.987h3.831c2.24-2.06 3.533-5.103 3.533-8.694z" />
                            <path fill="#34A853"
                                d="M12 24c3.24 0 5.962-1.07 7.95-2.903l-3.83-2.987c-1.065.713-2.42 1.134-4.12 1.134-3.168 0-5.855-2.142-6.812-5.025H1.153v3.16C3.126 21.46 7.29 24 12 24z" />
                            <path fill="#4A90E2"
                                d="M5.188 14.219a7.258 7.258 0 010-4.44V6.62H1.153a11.994 11.994 0 000 10.758l4.035-3.16z" />
                            <path fill="#FBBC05"
                                d="M12 4.77c1.757 0 3.335.603 4.58 1.784l3.44-3.44C17.96 1.36 15.24 0 12 0 7.29 0 3.126 2.54 1.153 6.62l4.035 3.16c.958-2.882 3.645-5.01 6.812-5.01z" />
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300 font-semibold">
                            Register dengan Google
                        </span>
                    </a>

                    <!-- Microsoft Register -->
                    <a href="{{ route('register.microsoft') }}"
                        class="w-full flex items-center justify-center gap-3 py-2 rounded text-white font-semibold bg-blue-700 hover:bg-blue-800 transition">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1" y="1" width="10" height="10" fill="#F35325" />
                            <rect x="13" y="1" width="10" height="10" fill="#81BC06" />
                            <rect x="1" y="13" width="10" height="10" fill="#05A6F0" />
                            <rect x="13" y="13" width="10" height="10" fill="#FFBA08" />
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300 font-semibold">
                            Register dengan Microsoft
                        </span>
                    </a>
                </div>
            </div>
        </form>

        <!-- Login -->
        <div class="text-center text-sm text-gray-500 dark:text-gray-400">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk di sini</a>
        </div>
    </div>
@endsection
