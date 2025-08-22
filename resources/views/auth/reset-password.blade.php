@extends('layout.auth.main')

@section('title', 'Reset Kata Sandi')
@section('aria-label', 'Halaman reset Kata Sandi')


@section('container')
    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
        <!-- Heading -->
        <div class="text-center">
            <div class="text-indigo-500 text-5xl mb-3">🔁</div>
            <h1 class="text-2xl font-bold">Atur Ulang Kata Sandi</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                Masukkan email dan kata sandi baru kamu
            </p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf

            <!-- Token dari URL -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium mb-1">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $email ?? '') }}"
                    class="w-full px-4 py-2 rounded border @error('email') border-red-500 dark:border-red-400 @else border-gray-300 dark:border-gray-700 @enderror bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @error('email')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-medium mb-1">Kata Sandi Baru</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 rounded border @error('password') border-red-500 dark:border-red-400 @else border-gray-300 dark:border-gray-700 @enderror bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @error('password')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-1">Konfirmasi Kata
                    Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 rounded transition">
                Simpan Kata Sandi Baru
            </button>
        </form>

        <!-- Back to Login -->
        <div class="text-center text-sm text-gray-500 dark:text-gray-400">
            Sudah ingat kata sandi lama?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Kembali ke Login</a>
        </div>
    </div>
@endsection
