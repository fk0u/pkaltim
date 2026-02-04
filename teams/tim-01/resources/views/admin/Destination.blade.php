@extends('layouts.admin')

@section('title', 'Kelola Destinasi')

@section('header_title', 'Kelola Destinasi')

@section('header_actions')
    <button onclick="toggleModal('createModal')"
        class="bg-active hover:bg-green-700 text-white px-5 py-2.5 rounded-lg font-medium shadow-lg shadow-green-500/30 transition-all flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Tambah Wisata
    </button>
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center text-active">
                <i class="fa-solid fa-map-location-dot text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Destinasi</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalDestinations }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase w-10">No</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Nama Wisata</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Lokasi</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Jam Buka</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Harga</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($destinations as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $destinations->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="block font-semibold text-gray-800">{{ $item->name }}</span>
                                <span class="text-xs text-gray-500 font-mono">{{ $item->slug }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($item->status == 'active')
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                    {{ $item->category->name ?? 'No Category' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 truncate max-w-[150px]"
                                title="{{ $item->address ?? $item->location }}">{{ $item->address ?? $item->location }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item->opening_hours ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-active">Rp
                                {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button onclick="openEditModal({{ $item }}, {{ $item->facilities->pluck('id') }})"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>

                                    <form action="{{ route('admin.destinations.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus?');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">Belum ada data destinasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">{{ $destinations->links() }}</div>
    </div>
@endsection

@push('modals')
    <div id="createModal"
        class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-3xl shadow-2xl my-8">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50 rounded-t-xl">
                <h3 class="text-lg font-bold text-gray-800">Tambah Destinasi</h3>
                <button onclick="toggleModal('createModal')" class="text-gray-400 hover:text-gray-600"><i
                        class="fa-solid fa-xmark text-xl"></i></button>
            </div>

            <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data"
                class="p-5 space-y-4">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Nama
                                Wisata</label>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-mountain-sun absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="name" id="create_name" onkeyup="generateSlug()" required
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none"
                                    placeholder="Masukkan nama wisata...">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Slug
                                (URL)</label>
                            <div class="relative">
                                <i class="fa-solid fa-link absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="slug" id="create_slug" required readonly
                                    class="w-full rounded-xl border-gray-200 bg-gray-100 pl-11 p-2.5 text-sm text-gray-500 cursor-not-allowed outline-none">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Kategori</label>
                        <div class="relative">
                            <i
                                class="fa-solid fa-layer-group absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 z-10"></i>
                            <select name="category_id" required
                                class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none appearance-none">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <i
                                class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Harga
                                Tiket</label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-xs">Rp</span>
                                <input type="number" name="price" required
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none"
                                    placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Lokasi /
                                Alamat</label>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="address" required
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none"
                                    placeholder="Alamat lengkap...">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Jam
                                Operasional</label>
                            <div class="relative">
                                <i class="fa-regular fa-clock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="opening_hours" placeholder="08:00 - 17:00"
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Status</label>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-toggle-on absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 z-10"></i>
                                <select name="status"
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none appearance-none">
                                    <option value="active">Active (Tampil)</option>
                                    <option value="inactive">Inactive (Sembunyi)</option>
                                </select>
                                <i
                                    class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Fasilitas</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        @foreach($facilities as $fac)
                            <label
                                class="relative flex items-center gap-2 p-2 bg-white border border-gray-200 rounded-lg cursor-pointer transition-all hover:bg-gray-50 has-[:checked]:border-green-500 has-[:checked]:shadow-sm has-[:checked]:bg-green-50/50">
                                <input type="checkbox" name="facilities[]" value="{{ $fac->id }}"
                                    class="w-4 h-4 text-green-600 rounded border-gray-300 focus:ring-green-500 transition-colors">
                                <span class="text-xs font-medium text-gray-700 flex items-center gap-1.5">
                                    <i class="{{ $fac->icon_class }} text-gray-400 w-4 text-center"></i>
                                    {{ $fac->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-xs font-bold text-gray-500 mb-2 uppercase tracking-wide flex items-center gap-2">
                        <i class="fa-solid fa-map-location-dot"></i> Koordinat Peta (Maps)
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Latitude</label>
                            <input type="text" name="latitude" placeholder="-0.502xxx"
                                class="w-full rounded-xl border-gray-200 bg-white p-2 text-xs transition-all focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Longitude</label>
                            <input type="text" name="longitude" placeholder="117.15xxx"
                                class="w-full rounded-xl border-gray-200 bg-white p-2 text-xs transition-all focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Deskripsi</label>
                    <textarea name="description" rows="2" required
                        class="w-full rounded-xl border-gray-200 bg-gray-50 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none"
                        placeholder="Jelaskan tentang destinasi ini..."></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Gambar Utama</label>
                    <div class="relative">
                        <input type="file" name="image" accept="image/*"
                            class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer border border-gray-200 rounded-xl bg-white pr-2">
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" onclick="toggleModal('createModal')"
                        class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-active text-white rounded-lg hover:bg-green-700">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal"
        class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-3xl shadow-2xl my-8">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50 rounded-t-xl">
                <h3 class="text-lg font-bold text-gray-800">Edit Destinasi</h3>
                <button onclick="toggleModal('editModal')" class="text-gray-400 hover:text-gray-600"><i
                        class="fa-solid fa-xmark text-xl"></i></button>
            </div>

            <form id="editForm" method="POST" enctype="multipart/form-data" class="p-5 space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Nama
                                Wisata</label>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-mountain-sun absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="edit_name" name="name" required
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Slug
                                (URL)</label>
                            <div class="relative">
                                <i class="fa-solid fa-link absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="edit_slug" name="slug" required readonly
                                    class="w-full rounded-xl border-gray-200 bg-gray-100 pl-11 p-2.5 text-sm text-gray-500 cursor-not-allowed outline-none">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Kategori</label>
                        <div class="relative">
                            <i
                                class="fa-solid fa-layer-group absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 z-10"></i>
                            <select name="category_id" id="edit_category_id" required
                                class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none appearance-none">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <i
                                class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Harga
                                Tiket</label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-xs">Rp</span>
                                <input type="number" id="edit_price" name="price" required
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Lokasi /
                                Alamat</label>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="edit_address" name="address" required
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Jam
                                Operasional</label>
                            <div class="relative">
                                <i class="fa-regular fa-clock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="edit_opening_hours" name="opening_hours"
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Status</label>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-toggle-on absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 z-10"></i>
                                <select name="status" id="edit_status"
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 pl-11 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none appearance-none">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <i
                                    class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Fasilitas</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        @foreach($facilities as $fac)
                            <label
                                class="relative flex items-center gap-2 p-2 bg-white border border-gray-200 rounded-lg cursor-pointer transition-all hover:bg-gray-50 has-[:checked]:border-green-500 has-[:checked]:shadow-sm has-[:checked]:bg-green-50/50">
                                <input type="checkbox" name="facilities[]" value="{{ $fac->id }}" id="edit_fac_{{ $fac->id }}"
                                    class="w-4 h-4 text-green-600 rounded border-gray-300 focus:ring-green-500 transition-colors">
                                <span class="text-xs font-medium text-gray-700 flex items-center gap-1.5">
                                    <i class="{{ $fac->icon_class }} text-gray-400 w-4 text-center"></i>
                                    {{ $fac->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-xs font-bold text-gray-500 mb-2 uppercase tracking-wide flex items-center gap-2">
                        <i class="fa-solid fa-map-location-dot"></i> Koordinat Peta (Maps)
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Latitude</label>
                            <input type="text" id="edit_latitude" name="latitude"
                                class="w-full rounded-xl border-gray-200 bg-white p-2 text-xs transition-all focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Longitude</label>
                            <input type="text" id="edit_longitude" name="longitude"
                                class="w-full rounded-xl border-gray-200 bg-white p-2 text-xs transition-all focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Deskripsi</label>
                    <textarea id="edit_description" name="description" rows="2" required
                        class="w-full rounded-xl border-gray-200 bg-gray-50 p-2.5 text-sm transition-all focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Ganti Gambar
                        (Opsional)</label>
                    <div class="relative">
                        <input type="file" name="image" accept="image/*"
                            class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer border border-gray-200 rounded-xl bg-white pr-2">
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" onclick="toggleModal('editModal')"
                        class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-active text-white rounded-lg hover:bg-green-700">Update
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function generateSlug() {
            const name = document.getElementById('create_name').value;
            const slug = name.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            document.getElementById('create_slug').value = slug;
        }

        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        function openEditModal(data, facilities) {
            // Isi form dengan data
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_slug').value = data.slug;
            document.getElementById('edit_price').value = data.price;
            document.getElementById('edit_address').value = data.address || data.location;
            document.getElementById('edit_description').value = data.description;
            document.getElementById('edit_category_id').value = data.category_id;

            // NEW FIELDS
            document.getElementById('edit_opening_hours').value = data.opening_hours;
            document.getElementById('edit_status').value = data.status;
            document.getElementById('edit_latitude').value = data.latitude;
            document.getElementById('edit_longitude').value = data.longitude;

            // Reset checkboxes
            const checkboxes = document.querySelectorAll('input[name="facilities[]"]');
            checkboxes.forEach(cb => cb.checked = false);

            // Check facilities for this destination
            if (facilities && Array.isArray(facilities)) {
                facilities.forEach(id => {
                    const cb = document.getElementById('edit_fac_' + id);
                    if (cb) cb.checked = true;
                });
            }

            // Atur URL form action
            let actionUrl = "{{ route('admin.destinations.index') }}/" + data.id;
            document.getElementById('editForm').action = actionUrl;

            // Buka modal
            toggleModal('editModal');
        }
    </script>
@endpush