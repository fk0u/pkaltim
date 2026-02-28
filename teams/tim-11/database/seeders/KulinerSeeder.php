<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kuliner;
use App\Models\Place;
use App\Models\Category;
use App\Models\User;

class KulinerSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create();
        }

        $kuliners = [
            [
                'place_name' => "D'Puncak",
                'nama_kuliner' => "Menu Kafe D'Puncak",
                'deskripsi' => 'Kafe dengan pemandangan city light dari ketinggian, menyajikan berbagai makanan dan minuman santai.',
                'asal_daerah' => 'Samarinda',
                'categories' => ['Makanan Berat', 'Minuman'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'Lopecoffee',
                'nama_kuliner' => 'Kopi & Pastry Lopecoffee',
                'deskripsi' => 'Kafe modern minimalis yang populer, tempat yang pas untuk menikmati kopi dan camilan.',
                'asal_daerah' => 'Samarinda',
                'categories' => ['Minuman', 'Makanan Ringan'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'Kopi Sajen',
                'nama_kuliner' => 'Kopi Sajen Signature',
                'deskripsi' => 'Menikmati kopi dengan suasana tenang dan homey untuk bersantai.',
                'asal_daerah' => 'Samarinda',
                'categories' => ['Minuman'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'Open House',
                'nama_kuliner' => 'Menu Tropis Open House',
                'deskripsi' => 'Kafe nuansa tropis dengan pemandangan laut, menyajikan hidangan fusion Western dan Asia.',
                'asal_daerah' => 'Balikpapan',
                'categories' => ['Makanan Berat', 'Minuman'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'The Beach House',
                'nama_kuliner' => 'Seafood Beach House',
                'deskripsi' => 'Kafe pinggir pantai dengan suasana rileks, spesialisasi hidangan laut segar.',
                'asal_daerah' => 'Balikpapan',
                'categories' => ['Seafood', 'Makanan Berat'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'Lotus Cafe',
                'nama_kuliner' => 'Menu Laut Lotus',
                'deskripsi' => 'Lokasi di pinggir laut Ruko Bandar, tempat yang cocok untuk makan malam romantis atau keluarga.',
                'asal_daerah' => 'Balikpapan',
                'categories' => ['Seafood', 'Minuman'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'Dandito Restaurant',
                'nama_kuliner' => 'Kepiting Saus Dandito',
                'deskripsi' => 'Spesialis Kepiting Saus Dandito & Seafood yang sudah sangat terkenal di Balikpapan.',
                'asal_daerah' => 'Balikpapan',
                'categories' => ['Seafood', 'Makanan Berat', 'Pedas', 'Manis'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'Pondok Borneo',
                'nama_kuliner' => 'Ikan Bakar & Kepiting Borneo',
                'deskripsi' => 'Restoran seafood legendaris, terkenal dengan Ikan Bakar & Kepiting olahan khas.',
                'asal_daerah' => 'Samarinda',
                'categories' => ['Seafood', 'Makanan Berat'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'RM Akmal',
                'nama_kuliner' => 'Sup Ikan Akmal',
                'deskripsi' => 'Terkenal dengan Sup Ikan Akmal yang khas, segar dan menggugah selera.',
                'asal_daerah' => 'Samarinda',
                'categories' => ['Seafood', 'Makanan Berat'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'Kampung Nasi Kuning',
                'nama_kuliner' => 'Nasi Kuning Ikan Haruan',
                'deskripsi' => 'Pusat Nasi Kuning khas Samarinda di Jl. Lambung Mangkurat, wajib coba dengan lauk ikan gabus/haruan.',
                'asal_daerah' => 'Samarinda',
                'categories' => ['Makanan Berat'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'Warung Nasi Kuning Ibu Cita',
                'nama_kuliner' => 'Nasi Kuning Ibu Cita',
                'deskripsi' => 'Nasi kuning autentik favorit warga lokal, rasa yang konsisten dan lezat.',
                'asal_daerah' => 'Samarinda',
                'categories' => ['Makanan Berat'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'RM Dinasti',
                'nama_kuliner' => 'Ikan Asam Pedas Dinasti',
                'deskripsi' => 'Menyajikan hidangan lokal & oriental seperti Ikan Asam Pedas yang legendaris.',
                'asal_daerah' => 'Samarinda',
                'categories' => ['Seafood', 'Pedas', 'Makanan Berat'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'Waroeng Mihun Acil Niah',
                'nama_kuliner' => 'Mihun Kampung Acil Niah',
                'deskripsi' => 'Mihun khas yang legendaris sejak 1980, sederhana namun nikmat.',
                'asal_daerah' => 'Samarinda',
                'categories' => ['Makanan Berat'],
                'is_halal' => true,
            ],
            [
                'place_name' => 'Kawasan Tepian Mahakam',
                'nama_kuliner' => 'Pisang Gapit Mahakam',
                'deskripsi' => 'Camilan pisang bakar saus gula merah khas Kaltim, dinikmati di pinggir Sungai Mahakam.',
                'asal_daerah' => 'Samarinda',
                'categories' => ['Kue Tradisional', 'Manis', 'Makanan Ringan'],
                'is_halal' => true,
            ],
        ];

        foreach ($kuliners as $data) {
            $place = Place::where('nama_tempat', $data['place_name'])->first();

            if ($place) {
                $kuliner = Kuliner::firstOrCreate(
                    ['nama_kuliner' => $data['nama_kuliner'], 'place_id' => $place->id],
                    [
                        'deskripsi' => $data['deskripsi'],
                        'asal_daerah' => $data['asal_daerah'],
                        'gambar' => null, // Bisa diisi URL placeholder jika ada
                        'created_by' => $user->id,
                        'is_halal' => $data['is_halal'],
                    ]
                );

                // Attach Categories
                $categoryIds = Category::whereIn('nama_kategori', $data['categories'])->pluck('id');
                $kuliner->categories()->sync($categoryIds);
            }
        }
    }
}
