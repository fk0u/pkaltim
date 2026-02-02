<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sireta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-white h-screen flex">

    <!-- Left Side - Form -->
    <div class="w-full md:w-1/2 flex flex-col justify-center px-8 md:px-16 lg:px-24">

         <a href="{{ route('landing') }}" class="flex items-center text-orange-300 hover:text-orange-400 mb-6 transition duration-150 ease-in-out w-fit">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-medium">Kembali</span>
        </a>

        <div class="mb-8 flex items-center">
            <img src="{{ asset('images/Sireta logo.png') }}" alt="Sireta Logo" class="h-12 w-12 rounded-full object-cover mr-3">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">SIRETA</h1>
                <p class="text-xs text-gray-500">Rasa Nusantara dari Timur</p>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Halo, Selamat Datang!</h2>
            <p class="text-gray-500">Silakan masuk ke akun Anda!</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <input type="email" name="email" placeholder="Email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent" required value="{{ old('email') }}">
            </div>

            <div class="mb-4 relative">
                <input type="password" name="password" id="password" placeholder="Password" class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent" required>
                <button type="button" onclick="togglePassword()" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>

            <div class="flex items-center mb-6">
                <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-orange-500 focus:ring-orange-400 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
            </div>

            <button type="submit" class="w-full bg-orange-400 hover:bg-orange-500 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Sign in
            </button>
        </form>
    </div>

    <!-- Right Side - Image -->
    <div class="hidden md:flex md:w-1/2 bg-orange-300 flex-col justify-center items-center p-10 rounded-l-[3rem]">
        <div class="text-center">
            <div class="bg-orange-300 rounded-full p-4 inline-block mb-6 ">
                <img src="{{ asset('images/Sireta logo.png') }}" alt="Sireta Logo" class="h-32 w-32 object-contain">
            </div>
            <h2 class="text-3xl font-bold text-white mb-2">Jelajahi Cita Rasa Kaltim</h2>
            <p class="text-white text-lg">Temukan kelezatan kuliner tradisional Kalimantan Timur</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Change to eye icon (visible)
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            } else {
                passwordInput.type = 'password';
                // Change to eye-off icon (hidden)
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            }
        }
    </script>

</body>
</html>
