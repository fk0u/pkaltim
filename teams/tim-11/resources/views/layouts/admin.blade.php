<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Sireta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                <a href="{{ route('kuliner.create') }}" class="block w-full bg-orange-500 text-white text-center py-3 rounded-lg font-medium hover:bg-orange-600 mb-6 transition">
                    + Tambah Kuliner
                </a>

                <nav class="space-y-1">
                    <a href="{{ route('dashboard.admin') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-lg {{ request()->routeIs('dashboard.admin') ? 'bg-orange-50 text-orange-500' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.kuliner.manage') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-lg {{ request()->routeIs('admin.kuliner.manage') ? 'bg-orange-50 text-orange-500' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <span>Manajemen Kuliner</span>
                    </a>
                    <a href="{{ route('admin.reviews.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-lg {{ request()->routeIs('admin.reviews.index') ? 'bg-orange-50 text-orange-500' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        <span>Moderasi Ulasan</span>
                    </a>
                    <a href="{{ route('admin.feedback.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-lg {{ request()->routeIs('admin.feedback*') ? 'bg-orange-50 text-orange-500' : '' }}">
                        <div class="relative">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            @php
                                $unreadFeedbackCount = \App\Models\Feedback::where('status', 'unread')->count();
                            @endphp
                            @if($unreadFeedbackCount > 0)
                                <span class="absolute -top-1 -right-1 flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                </span>
                            @endif
                        </div>
                        <span class="flex-1">Feedback</span>
                        @if($unreadFeedbackCount > 0)
                            <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $unreadFeedbackCount }}</span>
                        @endif
                    </a>

                     <a href="{{ route('admin.activity-logs') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-lg {{ request()->routeIs('admin.activity-logs') ? 'bg-orange-50 text-orange-500' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Riwayat Aktivitas</span>
                    </a>
                    <a href="{{ route('admin.guidelines') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-lg {{ request()->routeIs('admin.guidelines') ? 'bg-orange-50 text-orange-500' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Guidelines</span>
                    </a>
                </nav>
            </div>

            <!-- Profile Bottom -->
            <div class="absolute bottom-0 w-full p-4 border-t bg-white">
                <div class="flex items-center">
                    <div class="bg-orange-100 rounded-full p-2">
                         <span class="text-orange-500 font-bold">A</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="ml-auto">
                        @csrf
                        <button type="button" id="logout-button" class="text-gray-400 hover:text-red-500 transition-colors duration-200 p-2 rounded-full hover:bg-red-50" title="Logout">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
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

    <!-- Scripts -->
    <script>
        document.getElementById('logout-button').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: "Apakah Anda yakin ingin keluar dari sistem?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-2xl p-6',
                    title: 'text-gray-800 text-xl font-bold font-sans',
                    htmlContainer: 'text-gray-500 text-sm',
                    confirmButton: 'bg-orange-600 text-white px-6 py-2.5 rounded-xl font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200 mx-2',
                    cancelButton: 'bg-gray-200 text-gray-700 px-6 py-2.5 rounded-xl font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors duration-200 mx-2',
                    actions: 'mt-6 gap-3'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>
</body>
</html>
