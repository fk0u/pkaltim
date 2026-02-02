<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class GuidelinesController extends Controller
{
    /**
     * Display guidelines and policies
     * Read-only reference documentation
     */
    public function index(): View
    {
        $guidelines = [
            [
                'title' => 'Community Guidelines',
                'icon' => 'users',
                'items' => [
                    'Jaga sikap menghormati dalam setiap interaksi dengan pengguna lain',
                    'Tidak boleh melakukan diskriminasi berdasarkan SARA (Suku, Agama, Ras, Antar golongan)',
                    'Larangan mengirim pesan spam atau konten yang tidak relevan',
                    'Hindari penggunaan bahasa kasar atau ofensif',
                    'Jangan membagikan informasi pribadi pengguna tanpa izin'
                ]
            ],
            [
                'title' => 'Review Policy',
                'icon' => 'star',
                'items' => [
                    'Review harus bersifat autentik dan berdasarkan pengalaman nyata',
                    'Satu pengguna hanya dapat memberikan satu review per kuliner',
                    'Admin dapat menghapus review yang melanggar kebijakan',
                    'Review akan ditampilkan dalam urutan rating tertinggi terlebih dahulu',
                    'Foto dalam review harus relevan dengan kuliner yang di-review',
                    'Setiap review dapat menerima "like" dari pengguna lain'
                ]
            ],
            [
                'title' => 'Feedback Retention Policy',
                'icon' => 'clock',
                'items' => [
                    'Feedback disimpan selama 12 hari setelah menerima feedback',
                    'Setelah 12 hari, feedback akan dihapus otomatis dari sistem',
                    'Admin dapat menghapus feedback lebih awal jika diperlukan',
                    'Feedback yang sudah dibaca akan ditandai dengan status "read"',
                    'Sistem akan mengirimkan notifikasi sebelum feedback dihapus otomatis',
                    'Data feedback tidak dapat dipulihkan setelah dihapus'
                ]
            ],
            [
                'title' => 'Admin Responsibilities',
                'icon' => 'shield',
                'items' => [
                    'Setiap aktivitas admin dicatat dalam riwayat aktivitas untuk audit trail',
                    'Admin bertanggung jawab atas moderasi review dan feedback',
                    'Penghapusan konten harus sesuai dengan kebijakan yang berlaku',
                    'Admin harus merespons feedback dan laporan pengguna dengan cepat',
                    'Akses admin hanya diberikan kepada pengguna yang terpercaya',
                    'Admin tidak boleh menyalahgunakan akses untuk kepentingan pribadi'
                ]
            ],
            [
                'title' => 'Data Privacy',
                'icon' => 'lock',
                'items' => [
                    'Informasi pengguna dilindungi dengan enkripsi yang kuat',
                    'Data pengguna tidak akan dibagikan kepada pihak ketiga tanpa persetujuan',
                    'User dapat meminta penghapusan data pribadi mereka',
                    'Sistem menggunakan cookies untuk meningkatkan pengalaman pengguna',
                    'Admin harus menjaga kerahasiaan informasi sensitif pengguna',
                    'Akses ke data pengguna hanya untuk keperluan administrasi'
                ]
            ],
            [
                'title' => 'Content Policy',
                'icon' => 'document',
                'items' => [
                    'Konten harus sesuai dengan norma dan nilai-nilai lokal',
                    'Tidak boleh ada konten yang mempromosikan hal-hal ilegal atau berbahaya',
                    'Foto dan gambar harus bersifat edukatif dan relevan',
                    'Deskripsi kuliner harus akurat dan tidak menyesatkan',
                    'Tidak boleh ada iklan atau promosi yang tidak disetujui',
                    'Setiap konten yang dilaporkan akan ditinjau oleh admin'
                ]
            ]
        ];

        return view('admin.guidelines', compact('guidelines'));
    }
}
