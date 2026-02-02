<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'User Dashboard') - Sireta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg fixed h-full z-10">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-8">
                     <img src="{{ asset('images/Sireta logo.png') }}" alt="Sireta Logo" class="h-10 w-auto">
                     <div>
                        <h1 class="text-xl font-bold text-orange-500">SIRETA</h1>
                        <p class="text-xs text-gray-500">Jelajahi Cita Rasa Kaltim</p>
                     </div>
                </div>

                <nav class="space-y-1">
                    <a href="{{ route('dashboard.user') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-lg {{ request()->routeIs('dashboard.user') ? 'bg-orange-50 text-orange-500' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('user.favorites') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-lg {{ request()->routeIs('user.favorites') ? 'bg-orange-50 text-orange-500' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <span>Favorit Saya</span>
                    </a>
                </nav>
            </div>

            <!-- Profile Bottom -->
            <div class="absolute bottom-0 w-full p-4 border-t bg-white">
                <div class="flex items-center">
                    <div class="bg-orange-100 rounded-full p-2">
                         <span class="text-orange-500 font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="ml-3 overflow-hidden">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                     <form action="{{ route('logout') }}" method="POST" class="ml-auto">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-500" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
