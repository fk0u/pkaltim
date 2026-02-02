@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Kelola Pengguna</h2>
    <p class="text-gray-600">Manajemen pengguna terdaftar dan status akun.</p>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Nama</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Email</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Bergabung</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-gray-800 font-medium">{{ $user->name }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    <span id="status-badge-{{ $user->id }}" class="px-3 py-1 rounded-full text-xs font-semibold {{ $user->is_banned ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                        {{ $user->is_banned ? 'Banned' : 'Active' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-500 text-sm">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <button onclick="viewLogs({{ $user->id }}, '{{ $user->name }}')" class="text-blue-500 hover:text-blue-700 text-sm font-medium">Log Aktivitas</button>
                    <button onclick="toggleBan({{ $user->id }})" id="ban-btn-{{ $user->id }}" class="{{ $user->is_banned ? 'text-green-500 hover:text-green-700' : 'text-red-500 hover:text-red-700' }} text-sm font-medium">
                        {{ $user->is_banned ? 'Unban User' : 'Ban User' }}
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada pengguna terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Logs -->
<div id="logsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 max-h-[80vh] flex flex-col">
        <div class="flex justify-between items-center p-6 border-b">
            <h3 class="text-xl font-bold text-gray-800">Riwayat Aktivitas: <span id="modalUserName" class="text-orange-500"></span></h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto flex-1">
            <ul id="logsList" class="space-y-4">
                <!-- Logs loaded here -->
            </ul>
        </div>
        <div class="p-4 border-t bg-gray-50 text-right">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Tutup</button>
        </div>
    </div>
</div>

<script>
    function toggleBan(userId) {
        if(!confirm('Apakah Anda yakin ingin mengubah status ban pengguna ini?')) return;

        fetch(`/admin/users/${userId}/toggle-ban`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                const badge = document.getElementById(`status-badge-${userId}`);
                const btn = document.getElementById(`ban-btn-${userId}`);
                
                if(data.is_banned) {
                    badge.className = 'px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600';
                    badge.innerText = 'Banned';
                    btn.innerText = 'Unban User';
                    btn.className = 'text-green-500 hover:text-green-700 text-sm font-medium';
                } else {
                    badge.className = 'px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600';
                    badge.innerText = 'Active';
                    btn.innerText = 'Ban User';
                    btn.className = 'text-red-500 hover:text-red-700 text-sm font-medium';
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function viewLogs(userId, userName) {
        document.getElementById('modalUserName').innerText = userName;
        const list = document.getElementById('logsList');
        list.innerHTML = '<li class="text-center text-gray-500 py-4">Memuat data...</li>';
        
        document.getElementById('logsModal').classList.remove('hidden');
        document.getElementById('logsModal').classList.add('flex');

        fetch(`/admin/users/${userId}/logs`)
        .then(response => response.json())
        .then(data => {
            list.innerHTML = '';
            if(data.logs.length === 0) {
                list.innerHTML = '<li class="text-center text-gray-500 py-4">Tidak ada aktivitas tercatat.</li>';
                return;
            }

            data.logs.forEach(log => {
                const li = document.createElement('li');
                li.className = 'bg-gray-50 p-3 rounded border border-gray-100';
                li.innerHTML = `
                    <div class="flex justify-between items-start">
                        <span class="font-semibold text-gray-700 capitalize">${log.action.replace('_', ' ')}</span>
                        <span class="text-xs text-gray-500">${log.created_at}</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">${log.description}</p>
                `;
                list.appendChild(li);
            });
        })
        .catch(error => {
            list.innerHTML = '<li class="text-center text-red-500 py-4">Gagal memuat data.</li>';
            console.error('Error:', error);
        });
    }

    function closeModal() {
        document.getElementById('logsModal').classList.add('hidden');
        document.getElementById('logsModal').classList.remove('flex');
    }
</script>
@endsection
