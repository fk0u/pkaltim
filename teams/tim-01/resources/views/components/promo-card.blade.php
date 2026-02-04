@props(['promo'])

<div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-24 border border-gray-100">
    <!-- Header Gradient -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-500 p-6 text-white relative overflow-hidden">
        <div class="absolute -right-4 -top-4 text-white/10">
            <i class="fa-solid fa-tags text-8xl transform rotate-12"></i>
        </div>
        <h3 class="text-xl font-bold relative z-10">{{ $promo['title'] }}</h3>
        <p class="text-emerald-50 text-sm mt-1 relative z-10 opacity-90">Spesial untuk kamu!</p>
    </div>

    <!-- Body -->
    <div class="p-6">
        <p class="text-gray-600 text-sm mb-6 leading-relaxed">
            {{ $promo['description'] }}
        </p>

        <!-- Voucher Code Box -->
        <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-4 text-center mb-6 relative group cursor-pointer hover:bg-emerald-50 hover:border-emerald-200 transition-colors"
            onclick="navigator.clipboard.writeText('{{ $promo['code'] }}'); alert('Kode disalin!');">
            <p class="text-xs text-uppercase text-gray-400 font-semibold tracking-wider mb-1">KODE VOUCHER</p>
            <p
                class="text-2xl font-bold text-emerald-600 tracking-widest font-mono group-hover:scale-105 transition-transform">
                {{ $promo['code'] }}
            </p>
            <div class="absolute right-3 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                <i class="fa-regular fa-copy text-emerald-500"></i>
            </div>
        </div>

        <div class="flex items-center justify-between text-xs text-gray-400 mb-6">
            <span><i class="fa-regular fa-clock mr-1"></i> Berlaku hingga</span>
            <span class="font-medium text-gray-600">{{ $promo['valid_until'] }}</span>
        </div>

        <button
            class="w-full bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3.5 px-4 rounded-xl shadow-lg shadow-gray-200 hover:shadow-xl transition-all transform hover:-translate-y-0.5 active:translate-y-0">
            Klaim Sekarang
        </button>
    </div>
</div>