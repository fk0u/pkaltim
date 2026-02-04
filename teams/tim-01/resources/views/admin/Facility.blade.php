@extends('layouts.admin')

@section('title', 'Kelola Fasilitas')

@section('header_title', 'Kelola Fasilitas')

@section('header_actions')
    <button onclick="toggleModal('createModal')"
        class="bg-active hover:bg-green-700 text-white px-5 py-2.5 rounded-lg font-medium shadow-lg shadow-green-500/30 transition-all flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Tambah Fasilitas
    </button>
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center text-active">
                <i class="fa-solid fa-bell-concierge text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Fasilitas</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $facilities->total() }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase w-10">No</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-center w-20">Icon</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Nama Fasilitas</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Kode Icon (Class)</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($facilities as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-500 text-sm">
                                {{ $facilities->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div
                                    class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center mx-auto text-gray-600">
                                    <i class="{{ $item->icon_class }} text-lg"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block font-semibold text-gray-800">{{ $item->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono bg-gray-50 rounded">
                                {{ $item->icon_class }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button onclick="openEditModal({{ $item }})"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>

                                    <form action="{{ route('admin.facility.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus fasilitas {{ $item->name }}?');">
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
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">Belum ada data fasilitas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">{{ $facilities->links() }}</div>
    </div>
@endsection

@push('modals')
    <div id="createModal"
        class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50 rounded-t-2xl">
                <h3 class="text-lg font-bold text-gray-800">Tambah Fasilitas Baru</h3>
                <button onclick="toggleModal('createModal')" class="text-gray-400 hover:text-gray-600"><i
                        class="fa-solid fa-xmark text-xl"></i></button>
            </div>

            <form action="{{ route('admin.facility.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Fasilitas</label>
                    <input type="text" name="name" placeholder="Contoh: WiFi Gratis" required
                        class="w-full rounded-lg border-gray-300 border p-2.5 focus:border-green-500 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Icon Class (FontAwesome)
                        <a href="https://fontawesome.com/search?o=r&m=free" target="_blank"
                            class="text-green-600 hover:underline text-xs ml-1">(Cari Icon Disini)</a>
                    </label>
                    <input type="text" name="icon_class" placeholder="Contoh: fa-solid fa-wifi" required
                        class="w-full rounded-lg border-gray-300 border p-2.5 focus:border-green-500">
                    <p class="text-xs text-gray-400 mt-1">Gunakan class lengkap, misal: <span
                            class="font-mono text-gray-600">fa-solid fa-parking</span></p>
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
        <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50 rounded-t-2xl">
                <h3 class="text-lg font-bold text-gray-800">Edit Fasilitas</h3>
                <button onclick="toggleModal('editModal')" class="text-gray-400 hover:text-gray-600"><i
                        class="fa-solid fa-xmark text-xl"></i></button>
            </div>

            <form id="editForm" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Fasilitas</label>
                    <input type="text" id="edit_name" name="name" required
                        class="w-full rounded-lg border-gray-300 border p-2.5 focus:border-green-500 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Icon Class (FontAwesome)
                    </label>
                    <input type="text" id="edit_icon_class" name="icon_class" required
                        class="w-full rounded-lg border-gray-300 border p-2.5 focus:border-green-500">
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
@endpush

@push('scripts')
    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        function openEditModal(data) {
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_icon_class').value = data.icon_class;
            let actionUrl = "{{ route('admin.facility.index') }}/" + data.id;
            document.getElementById('editForm').action = actionUrl;
            toggleModal('editModal');
        }
    </script>
@endpush