<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Wisata Kaltim</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .bg-sidebar {
            background-color: #064e3b;
        }

        .bg-active {
            background-color: #10B981;
        }

        .text-active {
            color: #059669;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800"
    x-data="{ minimized: localStorage.getItem('sidebarMinimized') === 'true', mobileMenuOpen: false }"
    x-init="$watch('minimized', val => localStorage.setItem('sidebarMinimized', val))">

    <div class="flex h-screen overflow-hidden">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="mobileMenuOpen" class="fixed inset-0 z-40 md:hidden" role="dialog" aria-modal="true">
            <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-600 bg-opacity-75"
                @click="mobileMenuOpen = false"></div>

            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                class="relative flex-1 flex flex-col max-w-xs w-full bg-sidebar text-white shadow-xl h-full">

                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button type="button"
                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        @click="mobileMenuOpen = false">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile Logo Area -->
                <div class="h-20 flex items-center px-6 border-b border-gray-700/30">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-lg overflow-hidden flex items-center justify-center flex-shrink-0 shadow-lg">
                            <img src="{{ asset('WisataKaltim.jpeg') }}" alt="Admin Logo"
                                class="w-full h-full object-cover">
                        </div>
                        <span class="text-xl font-bold text-white tracking-tight">Wisata<span
                                class="text-brand-500">Kaltim</span></span>
                    </div>
                </div>

                <!-- Mobile Nav Links -->
                <nav class="mt-5 px-2 space-y-2 flex-1 overflow-y-auto">
                    @php
                        $navItems = [
                            ['route' => 'admin.dashboard', 'icon' => 'fa-chart-pie', 'label' => 'Dashboard'],
                            ['route' => 'admin.destinations.index', 'icon' => 'fa-map-location-dot', 'label' => 'Destinasi'],
                            ['route' => 'admin.category.index', 'icon' => 'fa-tags', 'label' => 'Kategori'],
                            ['route' => 'admin.gallery.selection', 'icon' => 'fa-images', 'label' => 'Galeri Wisata', 'active' => 'admin.gallery.*'],
                            ['route' => 'admin.facility.index', 'icon' => 'fa-bell-concierge', 'label' => 'Fasilitas'],
                            ['route' => 'admin.reviews.index', 'icon' => 'fa-star', 'label' => 'Review'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        @php
                            $isActive = request()->routeIs($item['active'] ?? $item['route']);
                            $activeClass = $isActive ? 'bg-active text-white shadow-lg shadow-green-900/50' : 'text-gray-400 hover:text-white hover:bg-white/10';
                        @endphp
                        <a href="{{ route($item['route']) }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ $activeClass }}">
                            <i class="fa-solid {{ $item['icon'] }} w-5 text-center"></i>
                            <span class="font-medium">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>

                <!-- Mobile User Profile -->
                <div class="p-4 border-t border-gray-700/30">
                    <div class="flex items-center gap-3 bg-gray-800/50 p-2 rounded-lg">
                        <img class="h-10 w-10 rounded-full object-cover border-2 border-green-500 flex-shrink-0"
                            src="https://ui-avatars.com/api/?name={{ Auth::user()->username ?? Auth::user()->name }}&background=00A651&color=fff"
                            alt="Admin Profile">
                        <div class="flex flex-col overflow-hidden">
                            <span
                                class="text-sm font-semibold text-white truncate">{{ Auth::user()->username ?? Auth::user()->name }}</span>
                            <span class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 text-xs text-red-400 hover:text-red-300 py-2 transition-colors">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>

            </div>
            <div class="flex-shrink-0 w-14" aria-hidden="true">
                <!-- Force sidebar to shrink to fit close icon -->
            </div>
        </div>

        <!-- Desktop Sidebar -->
        <aside :class="minimized ? 'w-20' : 'w-64'"
            class="bg-sidebar text-white flex flex-col justify-between hidden md:flex shadow-xl z-20 transition-all duration-300">
            <div>
                <!-- Logo Area -->
                <div class="h-20 flex items-center px-0 justify-center border-b border-gray-700/30 relative">
                    <div class="flex items-center gap-3"
                        :class="minimized ? 'justify-center' : 'px-8 w-full justify-start'">
                        <div class="w-10 h-10 rounded-lg overflow-hidden flex items-center justify-center flex-shrink-0 shadow-lg">
                            <img src="{{ asset('WisataKaltim.jpeg') }}" alt="Admin Logo" class="w-full h-full object-cover">
                        </div>
                        <span x-show="!minimized"
                            class="text-xl font-bold text-gray-900 dark:text-white tracking-tight whitespace-nowrap transition-opacity duration-200">Wisata<span
                                class="text-brand-500">Kaltim</span></span>
                    </div>
                </div>

                <!-- Nav Links -->
                <nav class="mt-8 px-2 space-y-2">
                    @php
                        $navItems = [
                            ['route' => 'admin.dashboard', 'icon' => 'fa-chart-pie', 'label' => 'Dashboard'],
                            ['route' => 'admin.destinations.index', 'icon' => 'fa-map-location-dot', 'label' => 'Destinasi'],
                            ['route' => 'admin.category.index', 'icon' => 'fa-tags', 'label' => 'Kategori'],
                            ['route' => 'admin.gallery.selection', 'icon' => 'fa-images', 'label' => 'Galeri Wisata', 'active' => 'admin.gallery.*'],
                            ['route' => 'admin.facility.index', 'icon' => 'fa-bell-concierge', 'label' => 'Fasilitas'],
                            ['route' => 'admin.reviews.index', 'icon' => 'fa-star', 'label' => 'Review'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        @php
                            $isActive = request()->routeIs($item['active'] ?? $item['route']);
                            $activeClass = $isActive ? 'bg-active text-white shadow-lg shadow-green-900/50' : 'text-gray-400 hover:text-white hover:bg-white/10';
                        @endphp
                        <a href="{{ route($item['route']) }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ $activeClass }}"
                            :class="minimized ? 'justify-center' : ''" title="{{ $item['label'] }}">
                            <i class="fa-solid {{ $item['icon'] }} w-5 text-center"></i>
                            <span x-show="!minimized"
                                class="font-medium whitespace-nowrap transition-opacity duration-200">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>

            <!-- User Profile -->
            <div class="p-4 border-t border-gray-700/30">
                <div class="flex items-center gap-3 bg-gray-800/50 p-2 rounded-lg"
                    :class="minimized ? 'justify-center' : ''">
                    <img class="h-10 w-10 rounded-full object-cover border-2 border-green-500 flex-shrink-0"
                        src="https://ui-avatars.com/api/?name={{ Auth::user()->username ?? Auth::user()->name }}&background=00A651&color=fff"
                        alt="Admin Profile">
                    <div x-show="!minimized" class="flex flex-col overflow-hidden transition-opacity duration-200">
                        <span
                            class="text-sm font-semibold text-white truncate">{{ Auth::user()->username ?? Auth::user()->name }}</span>
                        <span class="text-xs text-gray-400 truncate w-24">{{ Auth::user()->email }}</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-2 text-xs text-red-400 hover:text-red-300 py-2 transition-colors"
                        :class="minimized ? 'justify-center' : 'justify-center'">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span x-show="!minimized">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden bg-[#F9FAFB] relative">
            <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-4 md:px-8">
                <div class="flex items-center gap-4">
                    <!-- Mobile Toggle Button -->
                    <button @click="mobileMenuOpen = true"
                        class="text-gray-500 hover:text-gray-700 focus:outline-none md:hidden">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>

                    <!-- Desktop Toggle Button -->
                    <button @click="minimized = !minimized"
                        class="text-gray-500 hover:text-gray-700 focus:outline-none hidden md:block">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>

                    <div>
                        <h1 class="text-lg md:text-2xl font-bold text-gray-800">
                            @yield('header_title', 'Admin Dashboard')</h1>
                        @hasSection('header_subtitle')
                            <p class="text-sm text-gray-500 mt-1 hidden md:block">@yield('header_subtitle')</p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @yield('header_actions')
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-4 md:p-8">
                @if(session('success'))
                    <div
                        class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-3">
                        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('modals')
    @stack('scripts')
</body>

</html>