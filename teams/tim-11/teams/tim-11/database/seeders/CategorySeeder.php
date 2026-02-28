<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Makanan Berat',
            'Makanan Ringan',
            'Minuman',
            'Kue Tradisional',
            'Oleh-oleh',
            'Seafood',
            'Pedas',
            'Manis',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['nama_kategori' => $category]);
        }
    }
}
