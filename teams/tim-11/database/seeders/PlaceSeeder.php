<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    public function run()
    {
        Place::create([
            'nama_tempat' => 'Warung Nasi Kuning Ijay',
            'alamat' => 'Jl. Lambung Mangkurat, Samarinda',
            'kota' => 'Samarinda',
            'latitude' => -0.502183,
            'longitude' => 117.153770,
        ]);

        Place::create([
            'nama_tempat' => 'RM Torani',
            'alamat' => 'Jl. Juanda, Samarinda',
            'kota' => 'Samarinda',
            'latitude' => -0.490183,
            'longitude' => 117.143770,
        ]);

        Place::create([
            'nama_tempat' => 'Soto Banjar Amado',
            'alamat' => 'Jl. Diponegoro, Balikpapan',
            'kota' => 'Balikpapan',
            'latitude' => -1.267183,
            'longitude' => 116.823770,
        ]);
    }
}
