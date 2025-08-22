<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Title') - SSO SERVER</title>

    @stack('css')
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

            const adminDropdownBtn = document.getElementById('adminDropdownButton');
            const adminDropdownMenu = document.getElementById('adminDropdownMenu');

            adminDropdownBtn.addEventListener('click', function(event) {
                event.stopPropagation(); // prevent click from bubbling
                adminDropdownMenu.classList.toggle('hidden');
            });


            // Close dropdown if clicked outside
            window.addEventListener('click', function(e) {
                if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }

                if (!adminDropdownMenu.contains(e.target) && !adminDropdownBtn.contains(e.target)) {
                    adminDropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 min-h-screen text-gray-800 dark:text-gray-100">
    <!-- Header -->
    @include('layout.home.header')

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6">
        @yield('container')
    </main>

    @stack('scripts')
</body>

</html>
