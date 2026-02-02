@extends('layouts.admin')

@section('title', 'Riwayat Aktivitas')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Riwayat Aktivitas Admin</h1>
        <p class="text-gray-500 mt-1">Catatan audit trail semua aktivitas admin untuk pertanggungjawaban</p>
    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-lg">
        <p class="text-sm text-blue-700">
            <strong>ℹ️ Catatan:</strong> Log ini bersifat read-only dan tidak dapat diubah atau dihapus. Setiap aktivitas admin tercatat untuk audit trail dan pertanggungjawaban.
        </p>
    </div>

    <!-- Activity Logs Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 border-t-4 border-t-orange-500">
        <div class="overflow-x-auto">
            @if($logs->count() > 0)
                <table class="w-full text-left">
                    <thead class="bg-gradient-to-r from-orange-50 to-white border-b border-orange-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Admin</th>
                            <th class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Aksi</th>
                            <th class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($logs as $log)
                            <tr class="hover:bg-orange-50/50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-900 text-sm">{{ $log->created_at->format('d M Y') }}</span>
                                        <span class="text-orange-500 text-xs mt-0.5">{{ $log->created_at->format('H:i:s') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                            <span class="text-orange-600 font-semibold text-xs">{{ substr($log->user->name ?? 'Unknown', 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $log->user->name ?? 'Unknown' }}</p>
                                            <p class="text-gray-500 text-xs">{{ $log->user->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @php
                                        $actionLower = strtolower($log->action);
                                        $actionBadges = [
                                            'deleted' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'icon' => '🗑️'],
                                            'delete review' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'icon' => '🗑️'],
                                            'delete feedback' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'icon' => '🗑️'],
                                            'system auto-delete' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'icon' => '🤖'],
                                            'created' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'icon' => '✨'],
                                            'updated' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'icon' => '✏️'],
                                            'read feedback' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'icon' => '👁️'],
                                            'read' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'icon' => '👁️'],
                                            'ban_user' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'icon' => '⛔'],
                                            'unban_user' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'icon' => '✅'],
                                            'account_status_change' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'icon' => '⚠️'],
                                        ];
                                        $badge = $actionBadges[$actionLower] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'icon' => '📝'];
                                    @endphp
                                    <span class="inline-flex items-center space-x-1 px-3 py-1 rounded-full text-sm font-medium {{ $badge['bg'] }} {{ $badge['text'] }}">
                                        <span>{{ $badge['icon'] }}</span>
                                        <span class="capitalize">{{ $log->action }}</span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <span class="inline-block max-w-xs">{{ $log->description ?? '-' }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="bg-gray-50/50 border-t border-gray-100 px-6 py-4">
                    {{ $logs->links('pagination::tailwind') }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="mt-4 text-gray-500">Belum ada aktivitas admin yang tercatat</p>
                </div>
            @endif
        </div>
    </div>
@endsection
