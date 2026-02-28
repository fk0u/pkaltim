<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    public function run()
    {
        $places = [
            [
                'nama_tempat' => "D'Puncak",
                'alamat' => 'Jl. MT Haryono, Samarinda',
                'kota' => 'Samarinda',
                'latitude' => -0.505000,
                'longitude' => 117.150000,
            ],
            [
                'nama_tempat' => 'Lopecoffee',
                'alamat' => 'Jl. Gatot Subroto, Samarinda',
                'kota' => 'Samarinda',
                'latitude' => -0.498000,
                'longitude' => 117.160000,
            ],
            [
                'nama_tempat' => 'Kopi Sajen',
                'alamat' => 'Jl. Juanda, Samarinda',
                'kota' => 'Samarinda',
                'latitude' => -0.490000,
                'longitude' => 117.140000,
            ],
            [
                'nama_tempat' => 'Open House',
                'alamat' => 'Jl. Puncak Markoni Atas, Balikpapan',
                'kota' => 'Balikpapan',
                'latitude' => -1.270000,
                'longitude' => 116.830000,
            ],
            [
                'nama_tempat' => 'The Beach House',
                'alamat' => 'Jl. Mulawarman, Batakan, Balikpapan',
                'kota' => 'Balikpapan',
                'latitude' => -1.200000,
                'longitude' => 116.900000,
            ],
            [
                'nama_tempat' => 'Lotus Cafe',
                'alamat' => 'Ruko Bandar, Jl. Jend. Sudirman, Balikpapan',
                'kota' => 'Balikpapan',
                'latitude' => -1.280000,
                'longitude' => 116.820000,
            ],
            [
                'nama_tempat' => 'Dandito Restaurant',
                'alamat' => 'Jl. Marsma R. Iswahyudi, Balikpapan',
                'kota' => 'Balikpapan',
                'latitude' => -1.250000,
                'longitude' => 116.850000,
            ],
            [
                'nama_tempat' => 'Pondok Borneo',
                'alamat' => 'Jl. Mayor Jenderal Sutoyo, Samarinda',
                'kota' => 'Samarinda',
                'latitude' => -0.510000,
                'longitude' => 117.130000,
            ],
            [
                'nama_tempat' => 'RM Akmal',
                'alamat' => 'Jl. Wahid Hasyim, Samarinda',
                'kota' => 'Samarinda',
                'latitude' => -0.480000,
                'longitude' => 117.155000,
            ],
            [
                'nama_tempat' => 'Kampung Nasi Kuning',
                'alamat' => 'Jl. Lambung Mangkurat, Samarinda',
                'kota' => 'Samarinda',
                'latitude' => -0.502183,
                'longitude' => 117.153770,
            ],
            [
                'nama_tempat' => 'Warung Nasi Kuning Ibu Cita',
                'alamat' => 'Jl. Pasundan, Samarinda',
                'kota' => 'Samarinda',
                'latitude' => -0.495000,
                'longitude' => 117.145000,
            ],
            [
                'nama_tempat' => 'RM Dinasti',
                'alamat' => 'Jl. Ahmad Yani, Samarinda',
                'kota' => 'Samarinda',
                'latitude' => -0.485000,
                'longitude' => 117.158000,
            ],
            [
                'nama_tempat' => 'Waroeng Mihun Acil Niah',
                'alamat' => 'Jl. Danau Toba, Samarinda',
                'kota' => 'Samarinda',
                'latitude' => -0.508000,
                'longitude' => 117.152000,
            ],
            [
                'nama_tempat' => 'Kawasan Tepian Mahakam',
                'alamat' => 'Jl. Gajah Mada, Samarinda',
                'kota' => 'Samarinda',
                'latitude' => -0.500000,
                'longitude' => 117.120000,
            ],
        ];

        foreach ($places as $place) {
            Place::firstOrCreate(
                ['nama_tempat' => $place['nama_tempat']],
                $place
            );
        }
    }
}
