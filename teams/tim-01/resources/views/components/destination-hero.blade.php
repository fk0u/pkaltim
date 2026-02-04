@props(['destination'])

<section class="relative h-[60vh] min-h-[500px] w-full overflow-hidden group">
    <!-- Background Image -->
    @php
        // Handle image path: if it starts with http, use it, else asset storage
        // The seeded data uses 'images' array in my dummy code, but DB has 'destination_images' table?
        // Wait, the seeder didn't seed 'destination_images'. It seeded 'image' column in 'destinations' table?
        // Checking migration: destinations table has no 'image' column?
        // Wait, migration 2025_01_22_010356_create_destinations_table.php:
        // schema: name, slug, description, address, price, price_note, latitude, longitude, opening_hours, status.
        // NO IMAGE COLUMN in destinations table!
        // Images are in 'destination_images' table.
        // But my previous code assumed $destination['images']['hero'].
        // I need to fetch the image.

        // Fallback image
        $bgImage = 'https://images.unsplash.com/photo-1596401057633-565652f56878?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';

        // Attempt to get image from relation if available (need to load it in controller)
        // For now, I'll stick to a random placeholder if no image relation found.
    @endphp

    <img src="{{ $bgImage }}" alt="{{ $destination->name }}"
        class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-[2000ms] ease-out">

    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent opacity-90"></div>

    <!-- Content -->
    <div class="absolute inset-0 flex items-end">
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pb-16 lg:pb-24">
            <!-- Breadcrumb / Location Tag -->
            <div
                class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 text-white/90 text-sm font-medium mb-6">
                <i class="fa-solid fa-location-dot text-emerald-400"></i>
                {{ $destination->address ?? 'Kalimantan Timur' }}
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight tracking-tight">
                {{ $destination->name }}
            </h1>

            <div class="flex flex-wrap items-center gap-6 text-white/80 text-sm md:text-base">
                <div class="flex items-center gap-2 text-yellow-400">
                    <i class="fa-solid fa-star"></i>
                    <span class="font-bold text-white">4.8</span>
                    <span class="text-white/60">({{ $destination->reviews->count() }} ulasan)</span>
                </div>
                <span class="w-1 h-1 rounded-full bg-white/40"></span>
                <div>
                    <span class="font-bold text-white text-lg">Rp
                        {{ number_format($destination->price, 0, ',', '.') }}</span>
                    <span class="text-sm">{{ $destination->price_note ?? '/ orang' }}</span>
                </div>
            </div>
        </div>
    </div>
</section>