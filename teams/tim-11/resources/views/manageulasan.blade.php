@extends('layouts.admin')

@section('title', 'Manage Ulasan')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Ulasan</h2>
            <p class="text-gray-600">Moderasi ulasan pengguna.</p>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Reviews Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 border-t-4 border-t-orange-500">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-gray-500">
                <thead class="bg-gradient-to-r from-orange-50 to-white border-b border-orange-100">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">User</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Kuliner</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Rating</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider w-1/3">Ulasan</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Report Reason</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-orange-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($reviews as $review)
                        <tr class="hover:bg-orange-50/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gradient-to-br from-orange-400 to-red-400 flex items-center justify-center text-white font-bold text-xs">
                                        AN
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-semibold text-gray-900">Anonymous</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $review->kuliner->nama_kuliner }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $userRating = $review->kuliner->ratings->where('user_id', $review->user_id)->first();
                                @endphp
                                @if($userRating)
                                    <div class="flex items-center bg-yellow-50 text-yellow-700 px-2.5 py-1 rounded-lg w-fit">
                                        <span class="font-bold text-sm mr-1">{{ $userRating->rating }}</span>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600 line-clamp-2 leading-relaxed">{{ $review->ulasan }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($review->is_hidden)
                                    <span class="bg-red-50 text-red-600 text-xs px-3 py-1 rounded-full font-semibold border border-red-100">Deleted</span>
                                @else
                                    <span class="bg-green-50 text-green-600 text-xs px-3 py-1 rounded-full font-semibold border border-green-100">Active</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">{{ $review->report_reason ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">{{ $review->created_at->format('d M Y, H:i') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if(!$review->is_hidden)
                                    <button onclick="confirmDelete({{ $review->id }})" class="group inline-flex items-center justify-center w-8 h-8 bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all duration-200 shadow-sm hover:shadow-md" title="Hapus Ulasan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                @else
                                    <span class="text-gray-300 italic text-xs">Terhapus</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center bg-gray-50/30">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900">Belum ada ulasan</h3>
                                    <p class="text-gray-500 mt-1 text-sm">Ulasan pengguna akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Ulasan</h3>
                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus ulasan ini?</p>
            </div>

            <form id="deleteForm" method="POST" class="flex space-x-3">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Hapus</button>
            </form>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');

            form.action = `/admin/reviews/${id}`;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
@endsection
