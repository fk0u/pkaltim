@extends('layouts.app')

@section('title', 'Daftar Destinasi')

@section('content')

    <!-- Header / Banner -->
    <header class="relative pt-20 pb-20 md:pt-32 md:pb-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://lh3.googleusercontent.com/gps-cs-s/AHVAweqCfn2wgXu-qHU1M0N7a2P-QaHG6WCbttRp7K7qq4C5_Nr_hytuXgPT43ihTHsNljoaKSCXGAT1mJzHeBWbu4CVbGUjKpsRNTD20lH0B01WWW-CHV7k5mtOF3pXkOGrZMaICz1W=s1360-w1360-h1020-rw"
                alt="Pantai Melawai" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/60 via-gray-900/40 to-[#F8F9FA] dark:to-gray-900">
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-down">
                Cari Destinasi
            </h1>


            <div class="max-w-3xl relative z-10 mx-auto bg-white/20 backdrop-blur-md p-2 rounded-full shadow-2xl flex flex-col md:flex-row items-center gap-2 border border-white/30"
                data-aos="fade-up" data-aos-delay="200">
                <div class="flex-1 flex items-center px-6 w-full h-12">
                    <i class="fa-solid fa-search text-white mr-3"></i>
                    <!-- Added ID search-input -->
                    <input type="text" id="search-input" placeholder="Mau kemana hari ini?"
                        class="w-full bg-transparent outline-none text-white placeholder-gray-200">
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 md:px-8 pb-20 -mt-10 relative z-20">
        <div class="flex flex-col lg:flex-row gap-8">

            <aside class="w-full lg:w-3/12 space-y-8" data-aos="fade-right" data-aos-delay="300">
                <div
                    class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-xl shadow-gray-100/50 dark:shadow-none border border-gray-100 dark:border-gray-700 sticky top-28">
                    <div class="flex items-center justify-between mb-8 border-b border-gray-100 dark:border-gray-700 pb-4">
                        <h3 class="font-bold text-xl text-gray-900 dark:text-white flex items-center gap-2">
                            <i class="fa-solid fa-filter text-brand-500 text-sm"></i> Filter
                        </h3>
                        <button
                            class="text-xs text-brand-500 font-bold bg-brand-50 px-3 py-1.5 rounded-lg hover:bg-brand-100 transition-colors"
                            onclick="window.location.reload()">
                            Reset
                        </button>
                    </div>

                    <div class="mb-8">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Kategori</h4>
                        <div class="space-y-4">
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="checkbox" value="all" checked
                                    class="category-filter w-5 h-5 rounded-lg border-gray-300 text-brand-500 focus:ring-brand-500 transition cursor-pointer bg-gray-50">
                                <span
                                    class="group-hover:text-brand-500 text-gray-600 dark:text-gray-400 font-medium transition-colors">Semua
                                    Wisata</span>
                            </label>
                            @foreach($categories as $cat)
                                <label class="flex items-center space-x-3 cursor-pointer group">
                                    <input type="checkbox" value="{{ $cat->id }}"
                                        class="category-filter w-5 h-5 rounded-lg border-gray-300 text-brand-500 focus:ring-brand-500 transition cursor-pointer bg-gray-50">
                                    <span
                                        class="text-gray-600 dark:text-gray-400 group-hover:text-brand-500 font-medium transition-colors">{{ $cat->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Harga Maksimal</h4>
                            <span id="price-label"
                                class="text-[10px] font-bold text-white bg-brand-500 px-2.5 py-1 rounded-full shadow-sm shadow-brand-500/30">
                                IDR 500.000
                            </span>
                        </div>

                        <div class="relative w-full pt-4">
                            <input id="price-range" type="range" min="0" max="500000" step="10000" value="500000"
                                class="w-full h-1.5 bg-gray-100 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-brand-500 hover:accent-brand-600 focus:outline-none">
                            <div class="flex justify-between text-[10px] text-gray-400 mt-2 font-medium">
                                <span>IDR 0</span>
                                <span>IDR 500.000</span>
                            </div>
                        </div>
                        <p
                            class="text-[10px] text-gray-400 mt-3 flex items-center gap-1.5 bg-brand-50 dark:bg-brand-900/10 p-2 rounded-lg border border-brand-100 dark:border-brand-900/20 text-brand-600 dark:text-brand-400">
                            <i class="fa-solid fa-circle-info"></i> Geser untuk filter harga
                        </p>
                    </div>
                </div>
            </aside>

            <div class="w-full lg:w-9/12">
                <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                    <p class="text-gray-500 text-sm">Menampilkan <span id="count-display"
                            class="font-bold text-gray-900 dark:text-white bg-white px-2 py-0.5 rounded border border-gray-200 shadow-sm mx-1">{{ $destinations->count() }}</span>
                        Destinasi
                    </p>
                    <div
                        class="flex items-center gap-3 bg-white dark:bg-gray-800 p-1.5 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm">
                        <span class="text-xs font-bold text-gray-400 uppercase px-3">Urutkan</span>
                        <select
                            class="bg-gray-50 dark:bg-gray-700 font-semibold text-gray-700 dark:text-white border-none focus:ring-0 cursor-pointer text-sm rounded-lg py-1.5 pl-3 pr-8">
                            <option>Terpopuler</option>
                            <option>Harga Terendah</option>
                            <option>Rating Tertinggi</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="destination-grid">
                    @forelse($destinations as $item)
                        <div class="destination-card bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg border border-gray-100 dark:border-gray-700 group hover:shadow-xl transition duration-300 relative flex flex-col h-full"
                            data-price="{{ $item->price ?? 0 }}" data-name="{{ strtolower($item->name) }}"
                            data-category-id="{{ $item->category_id }}" data-aos="zoom-in"
                            data-aos-delay="{{ $loop->index * 100 }}">

                            <!-- Stretched Link -->
                            <a href="{{ route('destination.show', $item->slug) }}" class="absolute inset-0 z-10"
                                aria-label="Lihat detail {{ $item->name }}"></a>

                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ $item->thumbnail }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                    alt="{{ $item->name }}">

                                <div
                                    class="absolute top-4 right-4 bg-white/90 dark:bg-gray-900/90 backdrop-blur px-2.5 py-1 rounded-lg text-xs font-bold shadow-sm flex items-center gap-1 relative z-20">
                                    <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    {{ $item->rating ?? 'New' }}
                                </div>
                            </div>

                            <div class="p-5 flex flex-col flex-grow">
                                <p class="text-xs text-brand-500 font-semibold mb-1 uppercase tracking-wide">
                                    {{ $item->location ?? 'Kalimantan Timur' }}
                                </p>

                                <h3
                                    class="font-bold text-gray-900 dark:text-white text-lg mb-2 group-hover:text-brand-500 transition line-clamp-1">
                                    {{ $item->name }}
                                </h3>

                                <div class="flex items-center text-gray-400 text-xs mb-4 gap-2">
                                    <span
                                        class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-[10px] font-medium text-gray-600 dark:text-gray-300">
                                        {{ $item->category->name ?? 'Wisata' }}
                                    </span>
                                </div>

                                <div
                                    class="mt-auto flex justify-between items-center pt-4 border-t border-gray-100 dark:border-gray-700">
                                    <div>
                                        <p class="text-xs text-gray-400">Mulai dari</p>
                                        <span class="text-brand-600 dark:text-brand-400 font-bold text-lg">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div
                                        class="w-8 h-8 rounded-full bg-gray-50 dark:bg-gray-700 flex items-center justify-center text-gray-400 group-hover:bg-brand-500 group-hover:text-white transition-colors duration-300">
                                        <i
                                            class="fa-solid fa-arrow-right transform -rotate-45 group-hover:rotate-0 transition-transform duration-300 text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full text-center py-20 bg-white dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300">
                            <p class="text-gray-400">Belum ada data wisata.</p>
                        </div>
                    @endforelse
                </div>

                <div id="no-result-message"
                    class="hidden text-center py-20 bg-white dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300 mt-6">
                    <p class="text-gray-400">Tidak ada wisata yang sesuai kriteria.</p>
                </div>

                <div class="mt-12 flex justify-center">
                    <button
                        class="group px-8 py-3 bg-brand-500 hover:bg-brand-600 rounded-full text-sm font-bold shadow-lg shadow-brand-500/30 text-white flex items-center gap-2 transition-all duration-300 hover:-translate-y-1">
                        Muat Lebih Banyak
                        <i class="fa-solid fa-arrow-down group-hover:translate-y-1 transition text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Client Side Interaction Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const priceSlider = document.getElementById('price-range');
            const priceLabel = document.getElementById('price-label');
            const categoryCheckboxes = document.querySelectorAll('.category-filter');
            const cards = document.querySelectorAll('.destination-card');
            const noResult = document.getElementById('no-result-message');
            const countDisplay = document.getElementById('count-display');

            // Format Rupiah
            const formatRupiah = (number) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(number);
            };

            // Unified Filter Function
            const filterDestinations = () => {
                const searchValue = searchInput ? searchInput.value.toLowerCase() : '';
                const maxPrice = priceSlider ? parseInt(priceSlider.value) : 500000;

                // Get selected categories
                const selectedCategories = Array.from(categoryCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                const isAllSelected = selectedCategories.includes('all') || selectedCategories.length === 0;

                // Update Price Label
                if (priceLabel) priceLabel.innerText = formatRupiah(maxPrice);

                let visibleCount = 0;

                cards.forEach(card => {
                    const itemPrice = parseInt(card.getAttribute('data-price'));
                    // We added data-name, but fallback to h3 text if needed
                    const itemName = card.getAttribute('data-name') || card.querySelector('.destination-name').innerText.toLowerCase();
                    const itemCategoryId = card.getAttribute('data-category-id');

                    const matchesSearch = itemName.includes(searchValue);
                    const matchesPrice = itemPrice <= maxPrice;
                    const matchesCategory = isAllSelected || selectedCategories.includes(itemCategoryId);

                    if (matchesSearch && matchesPrice && matchesCategory) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update Count & No Result Message
                if (countDisplay) countDisplay.innerText = visibleCount;

                if (visibleCount === 0) {
                    noResult.classList.remove('hidden');
                } else {
                    noResult.classList.add('hidden');
                }
            };

            // Handle Checkbox Logic (Uncheck 'all' if specific selected, check 'all' if none selected)
            categoryCheckboxes.forEach(cb => {
                cb.addEventListener('change', function () {
                    if (this.value === 'all' && this.checked) {
                        // Uncheck others
                        categoryCheckboxes.forEach(other => {
                            if (other !== this) other.checked = false;
                        });
                    } else if (this.value !== 'all' && this.checked) {
                        // Uncheck 'all'
                        const allCb = document.querySelector('.category-filter[value="all"]');
                        if (allCb) allCb.checked = false;
                    }

                    // If everything unchecked, check 'all' back
                    const anyChecked = Array.from(categoryCheckboxes).some(cb => cb.checked);
                    if (!anyChecked) {
                        const allCb = document.querySelector('.category-filter[value="all"]');
                        if (allCb) allCb.checked = true;
                    }

                    filterDestinations();
                });
            });

            // Attach Listeners
            if (searchInput) {
                searchInput.addEventListener('input', filterDestinations);
            }

            if (priceSlider) {
                priceSlider.addEventListener('input', filterDestinations);
            }
        });
    </script>
@endsection