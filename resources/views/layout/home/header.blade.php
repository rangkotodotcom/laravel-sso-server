<header class="bg-white dark:bg-gray-800 shadow p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Left section: Logo + Navigation -->
        <div class="flex items-center space-x-10">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-2">
                <img src="https://placehold.co/400/png" alt="Logo" class="h-8 w-auto">
                <span class="text-xl font-bold text-gray-800 dark:text-white">SSO SERVER</span>
            </a>


            <!-- Navigation Menu -->
            <nav class="flex space-x-4 items-center">
                <!-- Link Biasa -->
                <a href="/"
                    class="px-3 py-2 rounded-md text-sm font-medium transition
                        {{ request()->is('/') ? 'bg-gray-200 dark:bg-gray-700 text-blue-600 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-white' }}">
                    Home
                </a>

                <a href="/apps"
                    class="px-3 py-2 rounded-md text-sm font-medium transition
                        {{ request()->is('apps*') ? 'bg-gray-200 dark:bg-gray-700 text-blue-600 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-white' }}">
                    Apps
                </a>

                <a href="/profile"
                    class="px-3 py-2 rounded-md text-sm font-medium transition
                        {{ request()->is('profile*') ? 'bg-gray-200 dark:bg-gray-700 text-blue-600 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-white' }}">
                    Profile
                </a>

                @if (auth()->user()?->role === 'admin')
                    <!-- Admin Tools Dropdown (with toggle click) -->
                    <div class="relative">
                        <button id="adminDropdownButton"
                            class="px-3 py-2 rounded-md text-sm font-medium flex items-center space-x-1 transition text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-white">
                            <span>Admin Tools</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="adminDropdownMenu"
                            class="absolute left-0 mt-2 w-52 bg-white dark:bg-gray-800 shadow-lg rounded-md py-2 z-50 hidden">
                            <a href="/admin/users"
                                class="block px-4 py-2 text-sm rounded-md mx-2 transition
                                    {{ request()->is('admin/users*') ? 'bg-gray-200 dark:bg-gray-700 text-blue-600 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-white' }}">
                                User Management
                            </a>
                            <a href="/admin/client"
                                class="block px-4 py-2 text-sm rounded-md mx-2 transition
                                    {{ request()->is('admin/client*') ? 'bg-gray-200 dark:bg-gray-700 text-blue-600 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-white' }}">
                                Client Management
                            </a>
                        </div>
                    </div>
                @endif
            </nav>


        </div>

        <!-- Right section: Profile + Dropdown -->
        <div class="relative">
            <button id="dropdownButton"
                class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}" alt="User Avatar"
                    class="w-8 h-8 rounded-full">
                <span>{{ auth()->user()->name }}</span>
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdownMenu"
                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-lg py-2 hidden z-50">
                <div class="flex items-center px-4 py-2 space-x-2">
                    <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}" alt="User Avatar"
                        class="w-10 h-10 rounded-full">
                    <span
                        class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</span>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>

                <a href="{{ route('logout') }}"
                    class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>

                @if (auth()->user()?->role === 'admin')
                    <a href="/admin/dashboard"
                        class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        Admin Dashboard
                    </a>
                @endif
            </div>
        </div>
    </div>
</header>
