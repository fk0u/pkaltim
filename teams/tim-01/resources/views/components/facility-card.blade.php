@props(['icon', 'label'])

<div
    class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-xl hover:bg-emerald-50 hover:border-emerald-100 border border-transparent transition-all group">
    <div
        class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 text-gray-500 group-hover:text-emerald-600 group-hover:scale-110 transition-transform">
        <i class="fa-solid {{ $icon }} text-xl"></i>
    </div>
    <span class="text-sm font-medium text-gray-700 text-center group-hover:text-emerald-800">{{ $label }}</span>
</div>