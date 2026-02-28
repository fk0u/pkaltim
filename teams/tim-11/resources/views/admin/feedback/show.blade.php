@extends('layouts.admin')

@section('title', 'View Feedback')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.feedback.index') }}" class="flex items-center text-gray-600 hover:text-orange-500 transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Inbox
        </a>
        
        @if($feedback->status === 'read')
            <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Delete this feedback permanently?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition text-sm font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Delete Feedback
                </button>
            </form>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-6 border-b border-gray-100 bg-gray-50/50">
            <div class="flex justify-between items-start">
                <div>
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2.5 py-0.5 rounded-full font-medium mb-3">
                        {{ $feedback->category }}
                    </span>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">{{ $feedback->subject ?? 'No Subject' }}</h1>
                    <div class="text-sm text-gray-500 flex items-center mt-2">
                        <span class="font-medium text-gray-900 mr-2">{{ $feedback->sender_name }}</span>
                        <span class="mr-2">•</span>
                        <span>{{ $feedback->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
                <div>
                    @if($feedback->status === 'unread')
                        <form action="{{ route('admin.feedback.read', $feedback->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition shadow-sm">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Mark as Read
                            </button>
                        </form>
                    @else
                        <span class="flex items-center text-green-600 bg-green-50 px-3 py-1 rounded-lg border border-green-200">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Read on {{ $feedback->read_at->format('d M, H:i') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-6 py-8">
            <div class="prose max-w-none text-gray-700 whitespace-pre-line leading-relaxed">
                {{ $feedback->message }}
            </div>
        </div>

        <!-- Metadata Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-xs text-gray-500 flex flex-col space-y-1">
            <p><span class="font-medium">Device Info:</span> {{ $feedback->device_info ?? 'Unknown' }}</p>
            <p><span class="font-medium">Received:</span> {{ $feedback->created_at }} ({{ $feedback->created_at->diffForHumans() }})</p>
        </div>
    </div>
@endsection
