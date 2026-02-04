<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Wisata Alam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            darkMode: 'class', // Penting: Mode gelap aktif berdasarkan class "dark" di tag HTML
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Transisi warna halus saat ganti mode */
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-[#F4F9F4] to-[#E3F6ED] dark:from-gray-900 dark:to-[#111827] min-h-screen flex flex-col justify-center items-center relative text-gray-800 dark:text-gray-200">

    <nav
        class="absolute top-0 left-0 w-full bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm shadow-sm dark:shadow-gray-800 z-50 px-6 md:px-8 py-4 flex justify-between items-center border-b border-transparent dark:border-gray-800">

        <a href="{{ url('/') }}" class="flex items-center gap-2 group hover:opacity-80 transition-opacity">
            <div class="w-10 h-10 rounded-xl overflow-hidden shadow-lg shadow-brand-500/20">
                <img src="{{ asset('WisataKaltim.jpeg') }}" alt="Wisata Kaltim Logo" class="w-full h-full object-cover">
            </div>
            <span class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">
                Wisata<span class="text-[#10B981]">Kaltim</span>
            </span>
        </a>

        <div class="flex items-center gap-4">
            <button id="theme-toggle"
                class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 dark:text-gray-400">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>

            <a href="/"
                class="hidden md:flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-all text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-[#10C858] dark:hover:text-[#10C858]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </nav>

    <div
        class="bg-white dark:bg-gray-800 rounded-[2rem] shadow-xl dark:shadow-none border border-transparent dark:border-gray-700 w-full max-w-[450px] p-10 z-10 mx-4 mt-20">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Masuk</h1>
        </div>

        @if ($errors->any())
            <div
                class="mb-4 bg-red-50 dark:bg-red-900/20 text-red-500 dark:text-red-400 text-xs px-4 py-3 rounded-xl border border-red-100 dark:border-red-800 flex gap-2 items-center animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span class="font-medium">{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-900 dark:text-gray-300 mb-2">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required
                    class="w-full px-4 py-3.5 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#10C858] focus:bg-white dark:focus:bg-gray-600 transition-all text-sm">
            </div>

            <div class="mb-2">
                <label class="block text-xs font-bold text-gray-900 dark:text-gray-300 mb-2">Kata Sandi</label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Kata sandi" required
                        class="w-full px-4 py-3.5 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#10C858] focus:bg-white dark:focus:bg-gray-600 transition-all text-sm pr-10">

                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3 top-3.5 text-gray-400 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400 transition-colors">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex justify-end mb-6">
                <a href="#"
                    class="text-xs font-bold text-[#10B981] hover:text-green-600 dark:hover:text-green-400 hover:underline transition-colors">Lupa
                    Kata Sandi?</a>
            </div>

            <button type="submit"
                class="w-full bg-[#10B981] hover:bg-green-600 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-green-200 dark:shadow-none transition-all transform active:scale-95 mb-6">
                Masuk
            </button>
        </form>
    </div>

    <script>
        // 1. Logic Toggle Password (Mata)
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.add('text-green-600', 'dark:text-green-400');
            } else {
                input.type = 'password';
                icon.classList.remove('text-green-600', 'dark:text-green-400');
            }
        }

        // 2. Logic Dark Mode
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Cek LocalStorage atau Preferensi Sistem saat halaman dimuat
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            themeToggleDarkIcon.classList.remove('hidden');
        }

        // Event Listener saat tombol diklik
        themeToggleBtn.addEventListener('click', function () {
            // Ganti Icon
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // Cek jika dark mode aktif
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
    </script>
</body>

</html>