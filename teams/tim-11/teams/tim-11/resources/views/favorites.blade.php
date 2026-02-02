<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Favorit Saya - Sireta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Glassmorphism */
        .glass { background: rgba(255,255,255,0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .glass-dark { background: rgba(0,0,0,0.3); backdrop-filter: blur(12px); }
        
        /* Gradient Backgrounds */
        .gradient-card { background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.7) 100%); }
        
        /* Card Hover */
        .card-hover { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .card-hover:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); }
        .card-hover:hover .card-img { transform: scale(1.1); }
        .card-img { transition: transform 0.5s ease; }
        
        /* Button Effects */
        .btn-shine { position: relative; overflow: hidden; }
        .btn-shine::after { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: linear-gradient(transparent, rgba(255,255,255,0.3), transparent); transform: rotate(45deg) translateX(-100%); transition: 0.6s; }
        .btn-shine:hover::after { transform: rotate(45deg) translateX(100%); }

        /* Input Focus */
        .input-glow:focus { box-shadow: 0 0 0 3px rgba(249,115,22,0.3); }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <!-- Navigation -->
    <nav class="glass shadow-lg sticky top-0 z-50 border-b border-white/20">
        <div class="px-6 lg:px-10 xl:px-16">
            <div class="flex justify-between items-center h-16">
                <!-- Logo - Left aligned with better spacing -->
                <a href="{{ route('landing') }}" class="flex items-center space-x-2.5 group">
                    <img class="h-9 w-auto transition-all duration-300 group-hover:scale-110 group-hover:rotate-3" src="{{ asset('images/Sireta logo.png') }}" alt="Sireta Logo">
                    <div class="flex flex-col leading-tight">
                        <span class="text-xl font-extrabold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent tracking-tight">SIRETA</span>
                        <span class="text-[10px] text-gray-400 font-medium tracking-wide hidden sm:block">Kuliner Kaltim</span>
                    </div>
                </a>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('landing') }}" class="px-4 py-2 text-gray-600 hover:text-orange-600 font-medium transition flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Beranda
                    </a>
                    <a href="{{ route('guest.favorites') }}" class="flex items-center px-4 py-2 rounded-full bg-orange-100 text-orange-600 font-medium transition-all duration-300">
                        <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        Favorit
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 flex flex-col items-center text-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Favorit Saya</h2>
                <p class="text-gray-600">Koleksi kuliner favorit yang telah kamu simpan.</p>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <form action="{{ route('guest.favorites') }}" method="GET"
                class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-4"
                onsubmit="syncFavoritesToForm(this)">
                <input type="hidden" name="ids" id="favIdsInput" value="{{ request('ids') }}">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari kuliner atau asal daerah..."
                        class="w-full px-4 py-2 rounded-lg border border-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="w-full md:w-1/4">
                    <select name="category"
                        class="w-full px-4 py-2 rounded-lg border border-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->nama_kategori }}"
                                {{ request('category') == $category->nama_kategori ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-2 rounded-xl font-bold hover:from-orange-600 hover:to-red-600 transition-all shadow-lg hover:shadow-xl btn-shine">Cari</button>
                @if (request('search') || request('category'))
                    <a href="{{ route('guest.favorites') }}"
                        class="px-4 py-2 bg-orange-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center justify-center">Reset</a>
                @endif
            </form>
        </div>

        <!-- Kuliner Cards Grid -->
        <div id="favoritesGrid">
            @if ($kuliners->isEmpty())
                <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                    <img src="https://img.icons8.com/ios-filled/100/FFA500/like--v1.png" class="mx-auto mb-4" alt="no favorites">
                    <h3 class="text-2xl text-gray-800 font-semibold mb-2">Belum ada favorit</h3>
                    <p class="text-gray-500 mb-6">Kamu belum menyimpan kuliner favorit. Temukan makanan lezat dan simpan favoritmu.</p>
                    <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 mt-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-full shadow-lg hover:scale-105 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3"></path></svg>
                        Jelajahi Kuliner
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($kuliners as $kuliner)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover cursor-pointer group kuliner-card" 
                            data-id="{{ $kuliner->id }}"
                            onclick="openKulinerModal({{ $kuliner->id }})">
                            <!-- Image -->
                            <div class="relative h-52 overflow-hidden">
                                @php
                                    $imgSrc = 'https://via.placeholder.com/640x360?text=No+Image';
                                    if ($kuliner->external_image_url) { $imgSrc = $kuliner->external_image_url; }
                                    elseif ($kuliner->gambar) { $imgSrc = asset('storage/' . $kuliner->gambar); }
                                @endphp
                                <img src="{{ $imgSrc }}" alt="{{ $kuliner->nama_kuliner }}" class="w-full h-full object-cover card-img" onerror="this.onerror=null;this.src='https://via.placeholder.com/640x360?text=No+Image';">
                                <div class="absolute inset-0 gradient-card opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <!-- Badges -->
                                <div class="absolute top-3 right-3 flex flex-col gap-2">
                                    @if ($kuliner->is_halal)
                                        <span class="bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs px-3 py-1.5 rounded-full font-bold shadow-lg">✓ Halal</span>
                                    @else
                                        <span class="bg-gradient-to-r from-red-500 to-rose-500 text-white text-xs px-3 py-1.5 rounded-full font-bold shadow-lg">Non-Halal</span>
                                    @endif
                                    @if ($kuliner->is_vegetarian)
                                        <span class="bg-gradient-to-r from-green-400 to-teal-400 text-white text-xs px-3 py-1.5 rounded-full font-bold shadow-lg">🌿 Vegetarian</span>
                                    @endif
                                </div>

                                <!-- Rating -->
                                <div class="absolute bottom-3 left-3 glass px-3 py-1.5 rounded-full flex items-center shadow-lg">
                                    <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="text-sm font-bold text-gray-800">{{ number_format($kuliner->average_rating, 1) }}</span>
                                </div>

                                <!-- Favorite Indicator (Always visible on Favorites Page) -->
                                <div class="absolute bottom-3 right-3 favorite-indicator" data-id="{{ $kuliner->id }}">
                                    <span class="bg-red-500 text-white p-2 rounded-full shadow-lg inline-block">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    </span>
                                </div>
                            </div>

                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-800 line-clamp-1 mb-2 group-hover:text-orange-500 transition-colors">{{ $kuliner->nama_kuliner }}</h3>
                                <p class="text-sm text-orange-600 font-semibold mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $kuliner->asal_daerah }}
                                </p>
                                <p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ $kuliner->deskripsi }}</p>

                                <!-- Categories -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach ($kuliner->categories as $cat)
                                        <span class="bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full font-medium">{{ $cat->nama_kategori }}</span>
                                    @endforeach
                                </div>

                                <!-- Place & Maps -->
                                <div class="flex items-center justify-between">
                                    @if ($kuliner->place)
                                        <div class="flex items-center text-xs text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            <span class="line-clamp-1">{{ $kuliner->place->nama_tempat }}</span>
                                        </div>
                                    @endif
                                    @if ($kuliner->google_maps_url)
                                        <a href="{{ $kuliner->google_maps_url }}" target="_blank" onclick="event.stopPropagation()" class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold rounded-full hover:from-blue-600 hover:to-blue-700 transition-all shadow-md hover:shadow-lg">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                            Maps
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-40 bg-blur hidden items-center justify-center z-50 p-4" onclick="closeModal(event)">
        <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-xl" onclick="event.stopPropagation()">
            <!-- Loading State -->
            <div id="modalLoading" class="flex items-center justify-center py-20">
                <svg class="animate-spin h-10 w-10 text-orange-500" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>

            <!-- Content -->
            <div id="modalContent" class="hidden">
                <div class="relative">
                    <img id="modalImage" src="" alt="" class="w-full h-80 object-cover">
                    <button onclick="closeDetailModal()" class="absolute top-4 right-4 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Favorite Button -->
                    <button id="btnFavorite" onclick="toggleFavorite()" class="absolute bottom-4 right-4 bg-white p-3 rounded-full shadow-lg text-gray-400 hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 md:p-8">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 id="modalTitle" class="text-3xl font-bold text-gray-900 mb-2"></h2>
                            <p id="modalOrigin" class="text-lg text-orange-600 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="text"></span>
                            </p>
                        </div>
                        <div class="text-center bg-gray-50 px-4 py-2 rounded-lg">
                            <div class="text-2xl font-bold text-gray-900 flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <span id="modalAvgRating">0.0</span>
                            </div>
                            <span class="text-xs text-gray-500">Rata-rata</span>
                        </div>
                    </div>

                    <div id="modalBadges" class="flex flex-wrap gap-2 mb-6"></div>

                    <p id="modalDesc" class="text-gray-700 leading-relaxed mb-8"></p>

                    <!-- User Rating Section -->
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Berikan Rating</h3>
                        <div class="flex items-center space-x-2">
                            <div class="flex space-x-1" id="starRating">
                                @for($i = 1; $i <= 5; $i++)
                                    <button onclick="submitRating({{ $i }})" class="star-btn w-8 h-8 text-gray-300 hover:text-yellow-400 focus:outline-none transition" data-value="{{ $i }}">
                                        <svg fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    </button>
                                @endfor
                            </div>
                            <span id="userRatingText" class="text-sm text-gray-500 ml-2"></span>
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ulasan (<span id="reviewCount">0</span>)</h3>

                        <!-- Write Review -->
                        <div class="mb-6">
                            <textarea id="reviewInput" rows="3" class="w-full rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 p-3 text-sm" placeholder="Tulis pengalaman kulinermu disini..."></textarea>
                            <div class="mt-2 text-right">
                                <button onclick="submitReview()" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition text-sm font-medium">Kirim Ulasan</button>
                            </div>
                        </div>

                        <!-- Review List -->
                        <div id="reviewList" class="space-y-6">
                            <!-- Reviews will be injected here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let currentKulinerId = null;

        // Initialize favorites from localStorage
        function getFavorites() {
            return JSON.parse(localStorage.getItem('favorites') || '[]');
        }

        function saveFavorites(favorites) {
            localStorage.setItem('favorites', JSON.stringify(favorites));
        }

        // On page load, sync localStorage favorites with URL if needed
        (function() {
            const favorites = getFavorites();
            const urlParams = new URLSearchParams(window.location.search);
            const idsInUrl = urlParams.get('ids');
            
            // If we have favorites in localStorage but no 'ids' param in URL, redirect with ids
            if (favorites.length > 0 && !idsInUrl) {
                urlParams.set('ids', favorites.join(','));
                window.location.search = urlParams.toString();
            }
            // If localStorage is empty but URL has filters, let it show empty state
        })();

        // Sync localStorage favorites to form before submit
        function syncFavoritesToForm(form) {
            const favorites = getFavorites();
            document.getElementById('favIdsInput').value = favorites.join(',');
        }

        function openKulinerModal(id) {
            currentKulinerId = id;
            const modal = document.getElementById('detailModal');
            const modalContent = document.getElementById('modalContent');
            const modalLoading = document.getElementById('modalLoading');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modalContent.classList.add('hidden');
            modalLoading.classList.remove('hidden');

            fetch(`/api/kuliner/${id}`)
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok');
                    return res.json();
                })
                .then(data => {
                    populateModal(data);
                    modalLoading.classList.add('hidden');
                    modalContent.classList.remove('hidden');
                })
                .catch(err => {
                    console.error(err);
                    alert('Gagal memuat data kuliner');
                    closeDetailModal();
                });
        }

        function populateModal(data) {
            const k = data.kuliner;

            // Image Logic
            let imageUrl = '';
            if (k.external_image_url) {
                imageUrl = k.external_image_url;
            } else if (k.gambar) {
                imageUrl = `{{ asset('storage') }}/${k.gambar}`;
            } else {
                imageUrl = 'https://via.placeholder.com/640x360?text=No+Image';
            }

            const imgEl = document.getElementById('modalImage');
            imgEl.src = imageUrl;
            imgEl.onerror = function() {
                this.onerror = null;
                this.src = 'https://via.placeholder.com/640x360?text=No+Image';
            };

            document.getElementById('modalTitle').textContent = k.nama_kuliner;
            document.querySelector('#modalOrigin .text').textContent = k.asal_daerah;
            document.getElementById('modalDesc').textContent = k.deskripsi;
            document.getElementById('modalAvgRating').textContent = parseFloat(data.average_rating).toFixed(1);

            // Badges
            let badgesHtml = '';
            if (k.is_halal) badgesHtml += '<span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium">Halal</span>';
            else badgesHtml += '<span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-medium">Non-Halal</span>';
            if (k.is_vegetarian) badgesHtml += '<span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium ml-2">Vegetarian</span>';

            k.categories.forEach(cat => {
                badgesHtml += `<span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full font-medium ml-2">${cat.nama_kategori}</span>`;
            });
            document.getElementById('modalBadges').innerHTML = badgesHtml;

            // Favorite Button State
            const favorites = getFavorites();
            updateFavoriteBtn(favorites.includes(currentKulinerId));

            // User Rating State
            updateStarDisplay(data.user_rating);

            // Reviews
            renderReviews(data.reviews);
        }

        function updateFavoriteBtn(isFavorited) {
            const btn = document.getElementById('btnFavorite');
            if (isFavorited) {
                btn.classList.add('text-red-500');
                btn.classList.remove('text-gray-400');
                btn.querySelector('svg').classList.add('fill-current');
            } else {
                btn.classList.remove('text-red-500');
                btn.classList.add('text-gray-400');
                btn.querySelector('svg').classList.remove('fill-current');
            }
        }

        function toggleFavorite() {
            if (!currentKulinerId) return;

            let favorites = getFavorites();
            const index = favorites.indexOf(currentKulinerId);
            
            if (index > -1) {
                favorites.splice(index, 1);
                updateFavoriteBtn(false);
                // Remove card from grid if on favorites page
                const card = document.querySelector(`.kuliner-card[data-id="${currentKulinerId}"]`);
                if (card) {
                    card.remove();
                }
                
                // Check if favorites is now empty and refresh page to show empty state
                if (favorites.length === 0) {
                    saveFavorites(favorites);
                    // Update URL to remove ids param
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.delete('ids');
                    window.location.search = urlParams.toString();
                    return;
                }
            } else {
                favorites.push(currentKulinerId);
                updateFavoriteBtn(true);
            }
            
            saveFavorites(favorites);

            // Sync with server
            fetch(`/guest/kuliner/${currentKulinerId}/favorite`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            }).catch(err => console.error(err));
        }

        function submitRating(rating) {
            if (!currentKulinerId) return;

            fetch(`/guest/kuliner/${currentKulinerId}/rate`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ rating: rating })
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    updateStarDisplay(data.rating);
                    document.getElementById('modalAvgRating').textContent = parseFloat(data.average_rating).toFixed(1);
                }
            })
            .catch(err => console.error(err));
        }

        function updateStarDisplay(rating) {
            const stars = document.querySelectorAll('.star-btn');
            stars.forEach(btn => {
                const val = parseInt(btn.dataset.value);
                if (val <= rating) {
                    btn.classList.remove('text-gray-300');
                    btn.classList.add('text-yellow-400');
                } else {
                    btn.classList.add('text-gray-300');
                    btn.classList.remove('text-yellow-400');
                }
            });
            const text = rating > 0 ? `Anda memberi rating ${rating}/5` : 'Belum ada rating';
            document.getElementById('userRatingText').textContent = text;
        }

        function submitReview() {
            const input = document.getElementById('reviewInput');
            const ulasan = input.value.trim();
            if (!ulasan || !currentKulinerId) return;

            fetch(`/guest/kuliner/${currentKulinerId}/review`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ ulasan: ulasan })
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    input.value = '';
                    openKulinerModal(currentKulinerId);
                }
            })
            .catch(err => console.error(err));
        }

        function renderReviews(reviews) {
            const container = document.getElementById('reviewList');
            document.getElementById('reviewCount').textContent = reviews.length;

            if (reviews.length === 0) {
                container.innerHTML = '<p class="text-gray-500 text-center py-4">Belum ada ulasan.</p>';
                return;
            }

            container.innerHTML = reviews.map(r => `
                <div class="flex space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="text-sm font-bold text-gray-900">Anonymous</h4>
                                <span class="text-xs text-gray-500">${new Date(r.created_at).toLocaleDateString('id-ID')}</span>
                            </div>
                            <p class="text-sm text-gray-700">${r.ulasan}</p>
                        </div>
                        <div class="flex items-center mt-1 space-x-4">
                            <button onclick="toggleReviewLike(${r.id})" class="flex items-center text-xs text-gray-500 hover:text-orange-500 transition group">
                                <svg class="w-4 h-4 mr-1 ${r.is_liked ? 'text-orange-500 fill-current' : ''}" id="likeIcon-${r.id}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                </svg>
                                <span id="likeCount-${r.id}">${r.likes_count}</span> Suka
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function toggleReviewLike(reviewId) {
            fetch(`/guest/review/${reviewId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(res => res.json())
            .then(data => {
                const icon = document.getElementById(`likeIcon-${reviewId}`);
                const count = document.getElementById(`likeCount-${reviewId}`);

                count.textContent = data.likes_count;
                if (data.status === 'added') {
                    icon.classList.add('text-orange-500', 'fill-current');
                } else {
                    icon.classList.remove('text-orange-500', 'fill-current');
                }
            })
            .catch(err => console.error(err));
        }

        function closeModal(event) {
            if (event.target.id === 'detailModal') {
                closeDetailModal();
            }
        }

        function closeDetailModal() {
            const modal = document.getElementById('detailModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            currentKulinerId = null;
        }

        // Escape key to close modal
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDetailModal();
            }
        });
    </script>

<!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 via-gray-800 to-black text-white pt-16 pb-8 mt-16 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Brand Section -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/Sireta logo.png') }}" alt="Sireta" class="h-10 w-auto opacity-90">
                        <span class="text-2xl font-bold bg-gradient-to-r from-orange-400 to-red-400 bg-clip-text text-transparent">SIRETA</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Sistem Informasi Kuliner Kalimantan Timur. Melestarikan dan memperkenalkan kekayaan cita rasa kuliner tradisional Nusantara dari Timur Borneo.
                    </p>
                    <div class="flex space-x-4 pt-2">
                        <a href="#" class="text-gray-400 hover:text-orange-500 transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                        <a href="#" class="text-gray-400 hover:text-orange-500 transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                    </div>
                </div>

                <!-- Explore Section -->
                <div>
                    <h4 class="text-white font-semibold mb-6 relative inline-block">
                        Jelajahi Kuliner
                        <span class="absolute bottom-0 left-0 w-1/2 h-1 bg-orange-500 rounded-full"></span>
                    </h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ route('guest.favorites') }}" class="hover:text-orange-400 transition flex items-center"><span class="mr-2">›</span> Semua Favorit</a></li>
                        <li><a href="{{ route('guest.favorites', ['category' => 'Makanan Berat']) }}" class="hover:text-orange-400 transition flex items-center"><span class="mr-2">›</span> Makanan Berat</a></li>
                        <li><a href="{{ route('guest.favorites', ['category' => 'Makanan Ringan']) }}" class="hover:text-orange-400 transition flex items-center"><span class="mr-2">›</span> Cemilan & Jajanan</a></li>
                        <li><a href="{{ route('guest.favorites', ['category' => 'Minuman']) }}" class="hover:text-orange-400 transition flex items-center"><span class="mr-2">›</span> Minuman Khas</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-6 relative inline-block">
                        Tautan Cepat
                        <span class="absolute bottom-0 left-0 w-1/2 h-1 bg-orange-500 rounded-full"></span>
                    </h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ route('landing') }}" class="hover:text-orange-400 transition">Beranda</a></li>
                        <li><a href="#" onclick="openFeedbackModal(); return false;" class="hover:text-orange-400 transition">Beri Masukan</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-orange-400 transition">Login Admin</a></li>
                        @auth
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="hover:text-red-500 transition text-left">Logout</button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-white font-semibold mb-6 relative inline-block">
                        Hubungi Kami
                        <span class="absolute bottom-0 left-0 w-1/2 h-1 bg-orange-500 rounded-full"></span>
                    </h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Jl. Aminah Syukur No.82, Samarinda, Kalimantan Timur</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <a href="mailto:info@sireta-kaltim.id" class="hover:text-white transition">info@sireta-kaltim.id</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>+62 0000 123456</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
                <p>&copy; {{ date('Y') }} SIRETA. Dibuat dengan ❤️ untuk Kuliner Indonesia.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                    <a href="#" class="hover:text-white transition">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
