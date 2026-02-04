<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Wisata Kaltim') - Jelajahi Borneo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#10B981', // Emerald Primary
                            600: '#059669',
                            900: '#064e3b',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script>
        // Check Dark Mode Configuration on Load
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <link rel="icon" href="{{ asset('WisataKaltim.jpeg') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Smooth transitions for dark mode */
        *,
        *::before,
        *::after {
            transition-property: background-color, border-color, color, fill, stroke;
            transition-duration: 200ms;
        }
    </style>
</head>

<body class="bg-[#F8F9FA] dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false }"
        class="fixed w-full z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md shadow-sm border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex justify-between items-center">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 rounded-lg overflow-hidden flex items-center justify-center shadow-sm">
                    <img src="{{ asset('WisataKaltim.jpeg') }}" alt="Wisata Kaltim Logo"
                        class="w-full h-full object-cover">
                </div>
                <span class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">Wisata<span
                        class="text-brand-500">Kaltim</span></span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('landing') }}"
                    class="text-sm font-medium hover:text-brand-500 dark:hover:text-brand-400">Beranda</a>
                <a href="{{ route('destination.index') }}"
                    class="text-sm font-medium hover:text-brand-500 dark:hover:text-brand-400">Destinasi</a>
            </div>

            <!-- Right Side (Auth & Dark Mode) -->
            <div class="flex items-center gap-4">

                <!-- Dark Mode Toggle -->
                <button id="theme-toggle"
                    class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 dark:text-gray-400 transition-colors">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <a href="{{ route('login') }}"
                    class="hidden md:block bg-brand-500 hover:bg-brand-600 text-white px-5 py-2 rounded-full text-sm font-bold shadow-lg shadow-brand-500/30 transition-transform hover:-translate-y-0.5">
                    Masuk
                </a>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden text-gray-500 hover:text-brand-500 focus:outline-none">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-collapse
            class="md:hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 absolute w-full left-0 top-20 shadow-lg">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ route('landing') }}"
                    class="block text-base font-medium text-gray-700 dark:text-gray-300 hover:text-brand-500 dark:hover:text-brand-400">
                    Beranda
                </a>
                <a href="{{ route('destination.index') }}"
                    class="block text-base font-medium text-gray-700 dark:text-gray-300 hover:text-brand-500 dark:hover:text-brand-400">
                    Destinasi
                </a>
                <a href="{{ route('login') }}"
                    class="block w-full text-center bg-brand-500 hover:bg-brand-600 text-white px-5 py-3 rounded-xl text-base font-bold shadow-lg shadow-brand-500/30 transition-transform hover:-translate-y-0.5">
                    Masuk
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-20"> <!-- Added padding top to account for fixed navbar -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 pt-16 pb-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">

                <!-- Brand -->
                <div class="col-span-1 md:col-span-2 space-y-4">
                    <a href="#" class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-lg overflow-hidden flex items-center justify-center shadow-sm">
                            <img src="{{ asset('WisataKaltim.jpeg') }}" alt="Wisata Kaltim Logo"
                                class="w-full h-full object-cover">
                        </div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Wisata<span
                                class="text-brand-500">Kaltim</span></span>
                    </a>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed max-w-sm">
                        Situs informasi pariwisata yang didedikasikan untuk memperkenalkan potensi alam Kalimantan
                        Timur, menghubungkan wisatawan dengan destinasi lokal.
                    </p>
                    <div class="flex space-x-4 pt-2">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 hover:bg-brand-500 hover:text-white transition"><i
                                class="fa-brands fa-instagram"></i></a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 hover:bg-brand-500 hover:text-white transition"><i
                                class="fa-brands fa-tiktok"></i></a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 hover:bg-brand-500 hover:text-white transition"><i
                                class="fa-brands fa-twitter"></i></a>
                    </div>
                </div>

                <div> </div>
                <!-- Links -->
                <div>
                    <h5 class="font-bold text-gray-900 dark:text-white mb-6">Navigasi</h5>
                    <ul class="space-y-3 text-sm text-gray-500 dark:text-gray-400">
                        <li><a href="{{ route('landing') }}" class="hover:text-brand-500 transition">Beranda</a></li>
                        <li><a href="{{ route('destination.index') }}" class="hover:text-brand-500 transition">Semua
                                Destinasi</a></li>
                    </ul>
                </div>


                <div
                    class="border-t border-gray-100 dark:border-gray-800 pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-gray-400">
                    <p>© 2026 Wisata Kaltim (Kelompok 1). All rights reserved.</p>
                </div>
            </div>
    </footer>

    <!-- Dark Mode Logic Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            // Apply correct icon on load
            if (document.documentElement.classList.contains('dark')) {
                lightIcon.classList.remove('hidden');
            } else {
                darkIcon.classList.remove('hidden');
            }

            themeToggleBtn.addEventListener('click', function () {
                // Toggle icons
                darkIcon.classList.toggle('hidden');
                lightIcon.classList.toggle('hidden');

                // Toggle theme logic
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
            });
        });
    </script>

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800,
        });
    </script>
</body>

</html>