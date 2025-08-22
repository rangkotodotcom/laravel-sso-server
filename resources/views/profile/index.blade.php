@extends('layout.home.main')

@section('title', 'Profile')


@section('container')
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded shadow p-6 space-y-6">

        <h1 class="text-3xl font-bold mb-4">Profile Information</h1>

        {{-- Profile Information Update --}}
        <form method="POST" action="{{ route('user-profile-information.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-medium mb-1">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}"
                    class="w-full rounded border px-3 py-2 dark:bg-gray-900 dark:border-gray-700" required>
                @error('name')
                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block font-medium mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}"
                    class="w-full rounded border px-3 py-2 dark:bg-gray-900 dark:border-gray-700" required>
                @error('email')
                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white rounded px-4 py-2 font-semibold transition">Update
                Profile</button>
        </form>

        {{-- Password Update --}}
        <section class="pt-6 border-t border-gray-300 dark:border-gray-700">
            <h2 class="text-xl font-semibold mb-4">Update Password</h2>

            <form method="POST" action="{{ route('user-password.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block font-medium mb-1">Current Password</label>
                    <input id="current_password" name="current_password" type="password"
                        class="w-full rounded border px-3 py-2 dark:bg-gray-900 dark:border-gray-700" required
                        autocomplete="current-password" />
                    @error('current_password')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block font-medium mb-1">New Password</label>
                    <input id="password" name="password" type="password"
                        class="w-full rounded border px-3 py-2 dark:bg-gray-900 dark:border-gray-700" required
                        autocomplete="new-password" />
                    @error('password')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block font-medium mb-1">Confirm New Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        class="w-full rounded border px-3 py-2 dark:bg-gray-900 dark:border-gray-700" required
                        autocomplete="new-password" />
                </div>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white rounded px-4 py-2 font-semibold transition">Update
                    Password</button>
            </form>
        </section>

        {{-- Two-Factor Authentication --}}
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
            <section class="pt-6 border-t border-gray-300 dark:border-gray-700">
                <h2 class="text-xl font-semibold mb-4">Two-Factor Authentication</h2>

                @if (is_null(auth()->user()->two_factor_secret))
                    {{-- Enable 2FA --}}
                    <form method="POST" action="{{ route('two-factor.enable') }}">
                        @csrf
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white rounded px-4 py-2 font-semibold transition">
                            Enable Two-Factor Authentication
                        </button>
                    </form>
                @elseif (is_null(auth()->user()->two_factor_confirmed_at))
                    {{-- Show QR + Confirm OTP --}}
                    <div class="mb-4">
                        <h3 class="font-medium mb-2">Scan this QR Code with your Authenticator App:</h3>
                        <div id="qr-code" class="bg-white p-4 rounded inline-block w-auto h-auto">
                            Loading...
                        </div>
                    </div>

                    <form method="POST" action="{{ route('two-factor.confirm') }}" class="space-y-4 mb-4">
                        @csrf
                        <label for="code" class="block text-sm font-medium">Enter OTP</label>
                        <input type="text" name="code" id="code" required
                            class="w-full px-4 py-2 border rounded dark:bg-gray-900 dark:border-gray-700" />
                        @error('code')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white rounded px-4 py-2 font-semibold transition">
                            Confirm OTP
                        </button>
                    </form>
                @else
                    {{-- Fully Enabled --}}
                    <p class="text-green-600 dark:text-green-400 font-medium mb-4">Two-Factor Authentication is enabled.
                    </p>

                    <div class="mb-4">
                        <h3 class="font-medium mb-2">Recovery Codes</h3>
                        <ul class="font-mono text-sm bg-gray-100 dark:bg-gray-900 p-4 rounded">
                            @foreach (auth()->user()->recoveryCodes() as $code)
                                <li>{{ $code }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <button id="regenerate-codes"
                        class="bg-yellow-600 hover:bg-yellow-700 text-white rounded px-4 py-2 font-semibold transition mr-2">
                        Regenerate Recovery Codes
                    </button>

                    <button id="disable-2fa"
                        class="bg-red-600 hover:bg-red-700 text-white rounded px-4 py-2 font-semibold transition">
                        Disable Two Factor Authentication
                    </button>
                @endif
            </section>
        @endif



        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="mt-8 w-full bg-red-600 hover:bg-red-700 text-white rounded px-4 py-2 font-semibold transition">
                Logout
            </button>
        </form>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (!auth()->user()->two_factor_confirmed_at && auth()->user()->two_factor_secret)
                // Load QR Code
                fetch("{{ route('two-factor.qr-code') }}", {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('qr-code').innerHTML = data.svg;
                    });
            @endif


            @if (auth()->user()->hasEnabledTwoFactorAuthentication())
                // Regenerate recovery codes
                document.getElementById('regenerate-codes').addEventListener('click', function(e) {
                    e.preventDefault();

                    fetch("{{ route('two-factor.recovery-codes') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    }).then(response => response.ok ? location.reload() : alert("Gagal regenerate"));
                });

                // Disable 2FA
                document.getElementById('disable-2fa').addEventListener('click', function(e) {
                    e.preventDefault();
                    if (!confirm('Are you sure you want to disable Two Factor Authentication?')) return;

                    fetch("{{ route('two-factor.disable') }}", {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    }).then(response => response.ok ? location.reload() : alert(
                        "Gagal disable 2FA"));
                });
            @endif
        });
    </script>
@endpush
