@extends('layouts.admin')

@section('title', 'Guidelines & Kebijakan')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Guidelines & Kebijakan Aplikasi</h1>
        <p class="text-gray-500 mt-1">Panduan dan aturan yang berlaku di platform Sireta</p>
    </div>

    <!-- Introduction Box -->
    <div class="bg-gradient-to-r from-orange-50 to-yellow-50 border-l-4 border-orange-500 p-6 mb-8 rounded-lg">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">📋 Tentang Guidelines Ini</h2>
        <p class="text-gray-700">
            Dokumen ini berisi panduan lengkap dan kebijakan yang berlaku untuk semua pengguna dan admin Sireta. 
            Silakan baca dengan seksama dan terapkan dalam setiap aktivitas Anda di platform ini.
        </p>
    </div>

    <!-- Guidelines Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Community Guidelines -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-l-4 border-blue-200 rounded-lg p-6 shadow-md hover:shadow-lg transition">
            <div class="flex items-center mb-4">
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 ml-4">Community Guidelines</h3>
            </div>
            <div class="space-y-3">
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">1</span>
                    <p class="text-gray-700 pt-0.5">Jaga sikap menghormati dalam setiap interaksi dengan pengguna lain</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">2</span>
                    <p class="text-gray-700 pt-0.5">Tidak boleh melakukan diskriminasi berdasarkan SARA (Suku, Agama, Ras, Antar golongan)</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">3</span>
                    <p class="text-gray-700 pt-0.5">Larangan mengirim pesan spam atau konten yang tidak relevan</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">4</span>
                    <p class="text-gray-700 pt-0.5">Hindari penggunaan bahasa kasar atau ofensif</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">5</span>
                    <p class="text-gray-700 pt-0.5">Jangan membagikan informasi pribadi pengguna tanpa izin</p>
                </div>
            </div>
        </div>

        <!-- Review Policy -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 border-l-4 border-green-200 rounded-lg p-6 shadow-md hover:shadow-lg transition">
            <div class="flex items-center mb-4">
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 ml-4">Review Policy</h3>
            </div>
            <div class="space-y-3">
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">1</span>
                    <p class="text-gray-700 pt-0.5">Review harus bersifat autentik dan berdasarkan pengalaman nyata</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">2</span>
                    <p class="text-gray-700 pt-0.5">Satu pengguna hanya dapat memberikan satu review per kuliner</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">3</span>
                    <p class="text-gray-700 pt-0.5">Admin dapat menghapus review yang melanggar kebijakan</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">4</span>
                    <p class="text-gray-700 pt-0.5">Review akan ditampilkan dalam urutan rating tertinggi terlebih dahulu</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">5</span>
                    <p class="text-gray-700 pt-0.5">Foto dalam review harus relevan dengan kuliner yang di-review</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">6</span>
                    <p class="text-gray-700 pt-0.5">Setiap review dapat menerima "like" dari pengguna lain</p>
                </div>
            </div>
        </div>

        <!-- Feedback Retention Policy -->
        <div class="bg-gradient-to-br from-red-50 to-pink-50 border-l-4 border-red-200 rounded-lg p-6 shadow-md hover:shadow-lg transition">
            <div class="flex items-center mb-4">
                <div class="bg-red-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 ml-4">Feedback Retention Policy</h3>
            </div>
            <div class="space-y-3">
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">1</span>
                    <p class="text-gray-700 pt-0.5">Feedback disimpan selama 12 hari setelah menerima feedback</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">2</span>
                    <p class="text-gray-700 pt-0.5">Setelah 12 hari, feedback akan dihapus otomatis dari sistem</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">3</span>
                    <p class="text-gray-700 pt-0.5">Admin dapat menghapus feedback lebih awal jika diperlukan</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">4</span>
                    <p class="text-gray-700 pt-0.5">Feedback yang sudah dibaca akan ditandai dengan status "read"</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">5</span>
                    <p class="text-gray-700 pt-0.5">Sistem akan mengirimkan notifikasi sebelum feedback dihapus otomatis</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">6</span>
                    <p class="text-gray-700 pt-0.5">Data feedback tidak dapat dipulihkan setelah dihapus</p>
                </div>
            </div>
        </div>

        <!-- Admin Responsibilities -->
        <div class="bg-gradient-to-br from-purple-50 to-pink-50 border-l-4 border-purple-200 rounded-lg p-6 shadow-md hover:shadow-lg transition">
            <div class="flex items-center mb-4">
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7.784-7.784a1 1 0 00-1.414-1.414L12 2.586l-7.37-7.37a1 1 0 00-1.414 1.414l7.37 7.37-7.37 7.37a1 1 0 101.414 1.414L12 14.414l7.37 7.37a1 1 0 001.414-1.414L13.414 12l7.37-7.37z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 ml-4">Admin Responsibilities</h3>
            </div>
            <div class="space-y-3">
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">1</span>
                    <p class="text-gray-700 pt-0.5">Setiap aktivitas admin dicatat dalam riwayat aktivitas untuk audit trail</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">2</span>
                    <p class="text-gray-700 pt-0.5">Admin bertanggung jawab atas moderasi review dan feedback</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">3</span>
                    <p class="text-gray-700 pt-0.5">Penghapusan konten harus sesuai dengan kebijakan yang berlaku</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">4</span>
                    <p class="text-gray-700 pt-0.5">Admin harus merespons feedback dan laporan pengguna dengan cepat</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">5</span>
                    <p class="text-gray-700 pt-0.5">Akses admin hanya diberikan kepada pengguna yang terpercaya</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">6</span>
                    <p class="text-gray-700 pt-0.5">Admin tidak boleh menyalahgunakan akses untuk kepentingan pribadi</p>
                </div>
            </div>
        </div>

        <!-- Data Privacy -->
        <div class="bg-gradient-to-br from-yellow-50 to-orange-50 border-l-4 border-yellow-200 rounded-lg p-6 shadow-md hover:shadow-lg transition">
            <div class="flex items-center mb-4">
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 ml-4">Data Privacy</h3>
            </div>
            <div class="space-y-3">
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">1</span>
                    <p class="text-gray-700 pt-0.5">Informasi pengguna dilindungi dengan enkripsi yang kuat</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">2</span>
                    <p class="text-gray-700 pt-0.5">Data pengguna tidak akan dibagikan kepada pihak ketiga tanpa persetujuan</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">3</span>
                    <p class="text-gray-700 pt-0.5">User dapat meminta penghapusan data pribadi mereka</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">4</span>
                    <p class="text-gray-700 pt-0.5">Sistem menggunakan cookies untuk meningkatkan pengalaman pengguna</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">5</span>
                    <p class="text-gray-700 pt-0.5">Admin harus menjaga kerahasiaan informasi sensitif pengguna</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">6</span>
                    <p class="text-gray-700 pt-0.5">Akses ke data pengguna hanya untuk keperluan administrasi</p>
                </div>
            </div>
        </div>

        <!-- Content Policy -->
        <div class="bg-gradient-to-br from-teal-50 to-cyan-50 border-l-4 border-teal-200 rounded-lg p-6 shadow-md hover:shadow-lg transition">
            <div class="flex items-center mb-4">
                <div class="bg-teal-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 ml-4">Content Policy</h3>
            </div>
            <div class="space-y-3">
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">1</span>
                    <p class="text-gray-700 pt-0.5">Konten harus sesuai dengan norma dan nilai-nilai lokal</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">2</span>
                    <p class="text-gray-700 pt-0.5">Tidak boleh ada konten yang mempromosikan hal-hal ilegal atau berbahaya</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">3</span>
                    <p class="text-gray-700 pt-0.5">Foto dan gambar harus bersifat edukatif dan relevan</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">4</span>
                    <p class="text-gray-700 pt-0.5">Deskripsi kuliner harus akurat dan tidak menyesatkan</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">5</span>
                    <p class="text-gray-700 pt-0.5">Tidak boleh ada iklan atau promosi yang tidak disetujui</p>
                </div>
                <div class="flex items-start space-x-3 text-sm">
                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-white text-gray-700 font-semibold text-xs flex-shrink-0">6</span>
                    <p class="text-gray-700 pt-0.5">Setiap konten yang dilaporkan akan ditinjau oleh admin</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-12 bg-gray-50 border-t-4 border-orange-500 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-3">⚠️ Pelanggaran Kebijakan</h3>
        <p class="text-gray-700 mb-4">
            Setiap pelanggaran terhadap guidelines di atas dapat mengakibatkan:
        </p>
        <ul class="space-y-2 text-gray-700 ml-4">
            <li class="flex items-center space-x-2">
                <span class="text-orange-500 font-bold">•</span>
                <span>Penghapusan konten yang melanggar</span>
            </li>
            <li class="flex items-center space-x-2">
                <span class="text-orange-500 font-bold">•</span>
                <span>Pembatasan akses sementara atau permanen</span>
            </li>
            <li class="flex items-center space-x-2">
                <span class="text-orange-500 font-bold">•</span>
                <span>Penangguhan atau pencabutan akun admin</span>
            </li>
            <li class="flex items-center space-x-2">
                <span class="text-orange-500 font-bold">•</span>
                <span>Tindakan hukum sesuai peraturan yang berlaku</span>
            </li>
        </ul>
        <p class="text-gray-700 mt-4 text-sm italic">
            Kami berkomitmen untuk menjaga integritas dan keamanan platform Sireta bagi semua pengguna.
        </p>
    </div>
@endsection
