@extends('layout.auth.main')

@section('title', 'Verifikasi Email')
@section('aria-label', 'Halaman Verifikasi email')

@section('container')
    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow space-y-6 text-center">
        <!-- Icon & Heading -->
        <div class="text-yellow-400 text-5xl mb-3">📨</div>
        <h1 class="text-2xl font-bold">Verifikasi Email</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            Sebelum melanjutkan, silakan cek email kamu dan klik link verifikasi yang kami kirimkan.
        </p>

        <!-- Status -->
        @if (session('status') === 'verification-link-sent')
            <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-sm rounded px-4 py-3">
                Link verifikasi baru telah dikirim ke email kamu.
            </div>
        @endif

        <!-- Resend Verification Form -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="mt-4 w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded transition">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="text-sm text-red-600 hover:underline">
                Logout
            </button>
        </form>
    </div>
@endsection
