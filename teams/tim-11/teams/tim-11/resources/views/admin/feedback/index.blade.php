@extends('layouts.admin')

@section('title', 'Feedback Management')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Feedback Inbox</h2>
        <p class="text-gray-600">Kelola masukan dari pengguna (Guest).</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tabs -->
    <div class="flex space-x-1 rounded-xl bg-gray-200 p-1 mb-6 w-fit">
        <button onclick="switchTab('unread')" id="tab-unread" class="w-32 py-2.5 text-sm font-bold leading-5 rounded-lg text-orange-700 bg-white shadow-md focus:outline-none focus:ring-2 ring-offset-2 ring-offset-orange-400 ring-white ring-opacity-60 transition-all duration-200">
            Unread
            @if($unreadFeedbacks->count() > 0)
                <span class="ml-1 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $unreadFeedbacks->count() }}</span>
            @endif
        </button>
        <button onclick="switchTab('read')" id="tab-read" class="w-32 py-2.5 text-sm font-medium leading-5 text-gray-700 hover:bg-white/[0.12] hover:text-gray-900 focus:outline-none focus:ring-2 ring-offset-2 ring-offset-orange-400 ring-white ring-opacity-60 transition">
            ReadHistory
        </button>
    </div>

    <!-- Unread Section -->
    <div id="unread-section" class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 border-t-4 border-t-orange-500 transition-all duration-300">
        <div class="px-6 py-4 border-b border-gray-100 bg-white">
            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                <div class="p-2 bg-green-100 rounded-full mr-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                Inbox (Unread)
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="bg-gradient-to-r from-orange-50 to-white border-b border-orange-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Category/Subject</th>
                        <th class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Sender</th>
                        <th class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Message Preview</th>
                        <th class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Received</th>
                        <th class="px-6 py-4 text-xs font-bold text-orange-600 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($unreadFeedbacks as $feedback)
                        <tr class="hover:bg-orange-50/50 transition-colors duration-200">
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $feedback->category }}</span>
                                <div class="font-medium text-gray-900 mt-1">{{ $feedback->subject ?? 'No Subject' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $feedback->sender_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ Str::limit($feedback->message, 50) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $feedback->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                No unread feedback. Good job! 🎉
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Read Section -->
    <div id="read-section" class="bg-white rounded-2xl shadow-xl overflow-hidden hidden border border-gray-100 border-t-4 border-t-gray-400 transition-all duration-300">
        <div class="px-6 py-4 border-b border-gray-100 bg-white">
            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                <div class="p-2 bg-gray-100 rounded-full mr-3">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path></svg>
                </div>
                Read History
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Sender</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Read At</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($readFeedbacks as $feedback)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $feedback->subject ?? 'No Subject' }}
                                <div class="text-xs text-gray-500 font-normal">{{ $feedback->category }}</div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $feedback->sender_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $feedback->read_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-3">
                                    <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="text-gray-600 hover:text-blue-600">View</a>
                                    <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                No history yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            const unreadSec = document.getElementById('unread-section');
            const readSec = document.getElementById('read-section');
            const tabUnread = document.getElementById('tab-unread');
            const tabRead = document.getElementById('tab-read');

            if (tab === 'unread') {
                unreadSec.classList.remove('hidden');
                readSec.classList.add('hidden');
                
                tabUnread.classList.add('bg-white', 'shadow', 'text-orange-700');
                tabUnread.classList.remove('text-gray-700', 'hover:bg-white/[0.12]');
                
                tabRead.classList.remove('bg-white', 'shadow', 'text-orange-700');
                tabRead.classList.add('text-gray-700', 'hover:bg-white/[0.12]');
            } else {
                readSec.classList.remove('hidden');
                unreadSec.classList.add('hidden');
                
                tabRead.classList.add('bg-white', 'shadow', 'text-orange-700');
                tabRead.classList.remove('text-gray-700', 'hover:bg-white/[0.12]');
                
                tabUnread.classList.remove('bg-white', 'shadow', 'text-orange-700');
                tabUnread.classList.add('text-gray-700', 'hover:bg-white/[0.12]');
            }
        }
    </script>
@endsection
