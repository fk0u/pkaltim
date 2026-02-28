@extends('layouts.admin')

@section('title', 'Manage Kuliner')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manage Kuliner</h2>
            <p class="text-gray-600">Daftar semua kuliner yang telah ditambahkan.</p>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Error Message -->
    @if (session('error'))
        <div
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
        <form action="{{ route('admin.kuliner.manage') }}" method="GET"
            class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari kuliner atau asal daerah..."
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
            <div class="w-full md:w-1/4">
                <select name="category"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
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
                class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-2 rounded-lg font-bold hover:from-orange-600 hover:to-red-600 transition-all shadow-md hover:shadow-lg">Cari</button>
            @if (request('search') || request('category'))
                <a href="{{ route('admin.kuliner.manage') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center justify-center">Reset</a>
            @endif
        </form>
    </div>

    <!-- Kuliner Cards Grid -->
    @if ($kuliners->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                </path>
            </svg>
            <p class="text-xl text-gray-600 font-medium">Belum ada data kuliner.</p>
            <p class="text-gray-500 mt-2">Silakan tambahkan kuliner baru.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($kuliners as $kuliner)
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 flex flex-col h-full">
                    <!-- Image (Clickable for Modal) -->
                    <div class="relative h-48 bg-gray-200 cursor-pointer" onclick="showDetail({{ $kuliner->id }})">
                        @php
                            $imgSrc = 'https://via.placeholder.com/640x360?text=No+Image';
                            if ($kuliner->external_image_url) {
                                $imgSrc = $kuliner->external_image_url;
                            } elseif ($kuliner->gambar) {
                                $imgSrc = asset('storage/' . $kuliner->gambar);
                            }
                        @endphp
                        <img src="{{ $imgSrc }}" alt="{{ $kuliner->nama_kuliner }}"
                            class="w-full h-full object-cover"
                            onerror="this.onerror=null;this.src='https://via.placeholder.com/640x360?text=No+Image';">

                        <!-- Badges -->
                        <div class="absolute top-2 right-2 flex flex-col space-y-1 items-end">
                            @if ($kuliner->is_halal)
                                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full shadow-sm">Halal</span>
                            @else
                                <span
                                    class="bg-red-500 text-white text-xs px-2 py-1 rounded-full shadow-sm">Non-Halal</span>
                            @endif

                            @if ($kuliner->is_vegetarian)
                                <span
                                    class="bg-green-600 text-white text-xs px-2 py-1 rounded-full shadow-sm">Veggie</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-4 flex-1 flex flex-col" onclick="showDetail({{ $kuliner->id }})"
                        style="cursor: pointer;">
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-gray-800 line-clamp-1"
                                    title="{{ $kuliner->nama_kuliner }}">{{ $kuliner->nama_kuliner }}</h3>
                            </div>

                            <p class="text-sm text-orange-600 font-medium mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $kuliner->asal_daerah }}
                            </p>

                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $kuliner->deskripsi }}</p>

                            <div class="flex flex-wrap gap-1 mb-3">
                                @foreach ($kuliner->categories as $cat)
                                    <span
                                        class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">{{ $cat->nama_kategori }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-xs text-gray-500 block mb-3">
                                @if ($kuliner->place)
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                    {{ $kuliner->place->nama_tempat }}
                                @endif
                            </span>

                            <div class="flex space-x-2" onclick="event.stopPropagation()">
                                @if ($kuliner->google_maps_url)
                                    <a href="{{ $kuliner->google_maps_url }}" target="_blank"
                                        class="flex-1 px-3 py-2 bg-blue-500 text-white text-xs rounded-lg hover:bg-blue-600 transition flex items-center justify-center"
                                        title="Lokasi Terpopuler">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 7m0 13V7">
                                            </path>
                                        </svg>
                                        Lokasi Terpopuler
                                    </a>
                                @endif
                                <a href="{{ route('kuliner.edit', $kuliner->id) }}"
                                    class="flex-1 px-3 py-2 bg-yellow-500 text-white text-xs rounded-lg hover:bg-yellow-600 transition flex items-center justify-center"
                                    title="Edit">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit
                                </a>
                                <button onclick="confirmDelete({{ $kuliner->id }}, '{{ $kuliner->nama_kuliner }}')"
                                    class="flex-1 px-3 py-2 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600 transition flex items-center justify-center"
                                    title="Hapus">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4"
        onclick="closeModal(event)">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
            <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-800" id="modalTitle">Detail Kuliner</h3>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div id="modalContent" class="p-6">
                <!-- Content will be loaded here -->
                <div class="flex items-center justify-center py-12">
                    <svg class="animate-spin h-10 w-10 text-orange-500" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Kuliner</h3>
                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus kuliner <strong
                        id="deleteKulinerName"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
            </div>

            <form id="deleteForm" method="POST" class="flex space-x-3">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()"
                    class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</button>
                <button type="submit"
                    class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Hapus</button>
            </form>
        </div>
    </div>

    <script>
        // Base URL dengan prefix dashboard/admin
        const baseUrl = '/dashboard/admin';

        function showDetail(id) {
            const modal = document.getElementById('detailModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            const url = `${baseUrl}/kuliner/${id}/show`;
            console.log('Fetching kuliner detail from:', url);

            // Fetch data dengan URL yang benar
            fetch(url)
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    document.getElementById('modalTitle').textContent = data.nama_kuliner;

                    let imageHtml = '';
                    let imageUrl = '';

                    if (data.external_image_url) {
                        imageUrl = data.external_image_url;
                    } else if (data.gambar) {
                        imageUrl = `{{ asset('storage') }}/${data.gambar}`;
                    } else {
                        imageUrl = 'https://via.placeholder.com/640x360?text=No+Image';
                    }

                    imageHtml = `<img src="${imageUrl}" alt="${data.nama_kuliner}"
                        class="w-full h-96 object-cover rounded-lg mb-6"
                        referrerpolicy="no-referrer"
                        onerror="this.onerror=null;this.src='https://via.placeholder.com/640x360?text=No+Image';">`;

                    let categoriesHtml = data.categories.map(cat =>
                        `<span class="bg-orange-100 text-orange-600 text-sm px-3 py-1 rounded-full">${cat.nama_kategori}</span>`
                    ).join('');

                    let badgesHtml = '';
                    if (data.is_halal) {
                        badgesHtml +=
                            '<span class="bg-green-500 text-white text-sm px-3 py-1 rounded-full">Halal</span>';
                    } else {
                        badgesHtml +=
                            '<span class="bg-red-500 text-white text-sm px-3 py-1 rounded-full">Non-Halal</span>';
                    }
                    if (data.is_vegetarian) {
                        badgesHtml +=
                            '<span class="bg-green-600 text-white text-sm px-3 py-1 rounded-full ml-2">Vegetarian</span>';
                    }

                    const content = `
                ${imageHtml}

                <div class="space-y-6">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Nama Kuliner</h4>
                        <p class="text-lg text-gray-800">${data.nama_kuliner}</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Asal Daerah</h4>
                        <p class="text-lg text-orange-600 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            ${data.asal_daerah}
                        </p>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Deskripsi</h4>
                        <p class="text-gray-700 leading-relaxed">${data.deskripsi}</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Kategori</h4>
                        <div class="flex flex-wrap gap-2">
                            ${categoriesHtml}
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Status</h4>
                        <div class="flex flex-wrap gap-2">
                            ${badgesHtml}
                        </div>
                    </div>

                    ${data.place ? `
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Lokasi</h4>
                                        <p class="text-gray-700 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            ${data.place.nama_tempat}
                                        </p>
                                    </div>
                                    ` : ''}

                    ${data.google_maps_url ? `
                                    <div>
                                        <a href="${data.google_maps_url}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 7m0 13V7"></path></svg>
                                            Lihat di Google Maps
                                        </a>
                                    </div>
                                    ` : ''}

                    ${data.creator ? `
                                    <div class="pt-4 border-t border-gray-200">
                                        <p class="text-sm text-gray-500">Dibuat oleh: <span class="font-medium text-gray-700">${data.creator.name}</span></p>
                                        <p class="text-sm text-gray-500">Pada: ${new Date(data.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
                                    </div>
                                    ` : ''}
                </div>
            `;

                    document.getElementById('modalContent').innerHTML = content;
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('modalContent').innerHTML = `
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-xl text-gray-600 font-medium mb-2">Gagal memuat data</p>
                    <p class="text-gray-500">Error: ${error.message}</p>
                </div>
            `;
                });
        }

        function closeDetailModal() {
            const modal = document.getElementById('detailModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function closeModal(event) {
            if (event.target.id === 'detailModal') {
                closeDetailModal();
            }
        }

        function confirmDelete(id, name) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const nameElement = document.getElementById('deleteKulinerName');

            nameElement.textContent = name;
            nameElement.textContent = name;
            // URL dengan prefix yang benar (/admin/kuliner) sesuai definisi route
            form.action = `/admin/kuliner/${id}/delete`;

            console.log('Delete form action:', form.action);

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDetailModal();
                closeDeleteModal();
            }
        });
    </script>
@endsection
