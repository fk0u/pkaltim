<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Facility;
use App\Models\DestinationImage;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Admin::truncate();
        Category::truncate();
        Facility::truncate();
        Destination::truncate();
        DestinationImage::truncate();
        Review::truncate();
        DB::table('destination_facilities')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ==========================================
        // 1. SEED ADMIN
        // ==========================================
        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('password'), // Default password
        ]);

        $this->command->info('✅ Admin user created (User: admin, Pass: password)');

        // ==========================================
        // 2. SEED FACILITIES
        // ==========================================
        $facilities = [
            ['name' => 'Area Parkir', 'icon_class' => 'fa-solid fa-square-parking'],
            ['name' => 'Toilet Umum', 'icon_class' => 'fa-solid fa-restroom'],
            ['name' => 'Mushola', 'icon_class' => 'fa-solid fa-mosque'],
            ['name' => 'Warung Makan', 'icon_class' => 'fa-solid fa-utensils'],
            ['name' => 'Spot Foto', 'icon_class' => 'fa-solid fa-camera'],
            ['name' => 'Gazebo', 'icon_class' => 'fa-solid fa-umbrella-beach'],
            ['name' => 'Camping Ground', 'icon_class' => 'fa-solid fa-campground'],
            ['name' => 'Penyewaan Alat', 'icon_class' => 'fa-solid fa-life-ring'],
            ['name' => 'Puncat View', 'icon_class' => 'fa-solid fa-mountain'],
            ['name' => 'Jungle Trekking', 'icon_class' => 'fa-solid fa-person-hiking'],
        ];

        foreach ($facilities as $fac) {
            Facility::create($fac);
        }
        $this->command->info('✅ Facilities seeded');

        // ==========================================
        // 3. SEED CATEGORIES
        // ==========================================
        $categories = [
            [
                'name' => 'Wisata Bahari',
                'description' => 'Menikmati keindahan laut, pantai, dan pesona bawah laut Kalimantan Timur.',
                'slug' => 'wisata-bahari'
            ],
            [
                'name' => 'Wisata Alam',
                'description' => 'Eksplorasi hutan tropis, air terjun, danau, dan pegunungan yang asri.',
                'slug' => 'wisata-alam'
            ],
            [
                'name' => 'Wisata Budaya & Edukasi',
                'description' => 'Mengenal kearifan lokal suku Dayak dan konservasi satwa endemik.',
                'slug' => 'wisata-budaya-edukasi'
            ]
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
        $this->command->info('✅ Categories seeded');

        // Fetch categories for relationship
        $catBahari = Category::where('slug', 'wisata-bahari')->first();
        $catAlam = Category::where('slug', 'wisata-alam')->first();
        $catBudaya = Category::where('slug', 'wisata-budaya-edukasi')->first();

        // ==========================================
        // 4. SEED DESTINATIONS
        // ==========================================
        $destinations = [
            [
                'category_id' => $catBahari->id,
                'name' => 'Pulau Derawan',
                'slug' => 'pulau-derawan',
                'description' => 'Destinasi wisata kelas dunia yang terkenal dengan keindahan bawah lautnya. Pulau Derawan adalah rumah bagi penyu hijau raksasa dan terumbu karang yang memukau. Sangat cocok untuk snorkeling dan diving.',
                'address' => 'Kepulauan Derawan, Kabupaten Berau',
                'price' => 50000,
                'price_note' => '/ orang (Retribusi)',
                'opening_hours' => '24 Jam',
                'latitude' => '2.2847',
                'longitude' => '118.2464',
                'status' => 'active',
                'facilities' => ['Area Parkir', 'Warung Makan', 'Penyewaan Alat', 'Spot Foto', 'Gazebo'],
            ],
            [
                'category_id' => $catAlam->id,
                'name' => 'Danau Labuan Cermin',
                'slug' => 'danau-labuan-cermin',
                'description' => 'Danau unik dengan fenomena dua rasa: air tawar di permukaan dan air asin di dasar. Airnya sangat jernih seperti cermin sehingga perahu terlihat melayang.',
                'address' => 'Biduk-Biduk, Kabupaten Berau',
                'price' => 30000,
                'price_note' => '/ orang (Sewa Perahu)',
                'opening_hours' => '08:00 - 17:00',
                'latitude' => '1.2583',
                'longitude' => '118.6961',
                'status' => 'active',
                'facilities' => ['Area Parkir', 'Spot Foto', 'Penyewaan Alat', 'Warung Makan']
            ],
            [
                'category_id' => $catAlam->id,
                'name' => 'Bukit Bangkirai',
                'slug' => 'bukit-bangkirai',
                'description' => 'Rasakan sensasi berjalan di jembatan gantung (Canopy Bridge) setinggi 30 meter di tengah hutan hujan tropis Kalimantan. Tempat terbaik untuk melihat vegetasi asli Borneo.',
                'address' => 'Samboja, Kabupaten Kutai Kartanegara',
                'price' => 45000,
                'price_note' => '/ orang (Tiket Masuk + Canopy)',
                'opening_hours' => '08:00 - 16:00',
                'latitude' => '-0.9634', // Approximate
                'longitude' => '116.8904',
                'status' => 'active',
                'facilities' => ['Area Parkir', 'Toilet Umum', 'Mushola', 'Jungle Trekking', 'Warung Makan', 'Spot Foto']
            ],
            [
                'category_id' => $catBudaya->id,
                'name' => 'Desa Budaya Pampang',
                'slug' => 'desa-budaya-pampang',
                'description' => 'Desa wisata yang dihuni oleh suku Dayak Kenyah. Setiap akhir pekan diadakan pertunjukan tari tradisional dan pameran kerajinan tangan khas Dayak.',
                'address' => 'Sungai Siring, Kota Samarinda',
                'price' => 25000,
                'price_note' => '/ orang',
                'opening_hours' => 'Sabtu - Minggu: 14:00 - 16:00',
                'latitude' => '-0.3871',
                'longitude' => '117.2285',
                'status' => 'active',
                'facilities' => ['Area Parkir', 'Toilet Umum', 'Spot Foto', 'Warung Makan']
            ],
            [
                'category_id' => $catAlam->id,
                'name' => 'Taman Nasional Kutai',
                'slug' => 'taman-nasional-kutai',
                'description' => 'Habitat asli Orangutan Kalimantan (Pongo pygmaeus morio) dan Beruang Madu. Tempat terbaik untuk wisata konservasi dan melihat satwa liar di alam bebas.',
                'address' => 'Kutai Timur & Bontang',
                'price' => 10000,
                'price_note' => '/ orang',
                'opening_hours' => '08:00 - 16:00',
                'latitude' => '0.3667',
                'longitude' => '117.2500',
                'status' => 'active',
                'facilities' => ['Jungle Trekking', 'Camping Ground', 'Toilet Umum', 'Gazebo']
            ],
            [
                'category_id' => $catBahari->id,
                'name' => 'Pantai Melawai',
                'slug' => 'pantai-melawai',
                'description' => 'Ikon wisata Kota Balikpapan. Tempat nongkrong favorit warga lokal sambil menikmati sunset dan pemandangan Pulau Babi di kejauhan.',
                'address' => 'Jl. Jenderal Sudirman, Balikpapan',
                'price' => 0,
                'price_note' => 'Gratis Pakir',
                'opening_hours' => '16:00 - 23:00',
                'latitude' => '-1.2725',
                'longitude' => '116.8159',
                'status' => 'active',
                'facilities' => ['Area Parkir', 'Warung Makan', 'Toilet Umum', 'Spot Foto']
            ],
            [
                'category_id' => $catBahari->id,
                'name' => 'Pulau Kakaban',
                'slug' => 'pulau-kakaban',
                'description' => 'Pulau unik dengan danau air payau di tengahnya yang dihuni oleh jutaan ubur-ubur tanpa sengat. Pengalaman berenang bersama ubur-ubur yang langka.',
                'address' => 'Kepulauan Derawan, Kabupaten Berau',
                'price' => 45000,
                'price_note' => '/ orang',
                'opening_hours' => '07:00 - 17:00',
                'latitude' => '2.1492',
                'longitude' => '118.5250',
                'status' => 'active',
                'facilities' => ['Spot Foto', 'Penyewaan Alat'] // Minim fasilitas
            ]
        ];

        foreach ($destinations as $dest) {
            // Extract relations
            $facs = $dest['facilities'] ?? [];
            $imgs = $dest['images'] ?? [];
            unset($dest['facilities'], $dest['images']);

            // Create Destination
            $newDest = Destination::create($dest);

            // Attach Facilities
            $facilityIds = Facility::whereIn('name', $facs)->pluck('id');
            $newDest->facilities()->attach($facilityIds);

            // Add Images
            foreach ($imgs as $index => $imgUrl) {
                DestinationImage::create([
                    'destination_id' => $newDest->id,
                    'image_path' => $imgUrl, // Full URL
                    'is_primary' => $index === 0 // First image is primary
                ]);
            }

            // Seed 2-3 Reviews per destination
            Review::create([
                'destination_id' => $newDest->id,
                'visitor_name' => 'Traveler ' . Str::random(3),
                'rating' => rand(4, 5),
                'comment' => 'Tempat yang luar biasa! Pemandangannya sangat indah dan suasananya tenang.',
                'status' => 'approved'
            ]);

            Review::create([
                'destination_id' => $newDest->id,
                'visitor_name' => 'Pengunjung ' . Str::random(3),
                'rating' => rand(3, 5),
                'comment' => 'Fasilitas cukup memadai, namun akses jalan menuju lokasi perlu perbaikan sedikit.',
                'status' => 'approved'
            ]);
        }

        $this->command->info('✅ Destinations, Images (null) & Reviews seeded successfully!');
    }
}
