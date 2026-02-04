@props(['review'])

<div class="border-b border-gray-100 pb-8 last:border-0 last:pb-0">
    <div class="flex items-start gap-4">
        <!-- Avatar -->
        <img src="https://ui-avatars.com/api/?name={{ urlencode($review->visitor_name) }}&background=random"
            alt="{{ $review->visitor_name }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-gray-100">

        <div class="flex-1">
            <div class="flex justify-between items-start mb-1">
                <h4 class="text-base font-bold text-gray-900">{{ $review->visitor_name }}</h4>
                <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
            </div>

            <div class="flex text-yellow-400 text-xs mb-3">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fa-solid fa-star {{ $i <= $review->rating ? '' : 'text-gray-200' }}"></i>
                @endfor
            </div>

            <p class="text-gray-600 text-sm leading-relaxed">
                {{ $review->comment }}
            </p>
        </div>
    </div>
</div>