@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    Your Chatbots
                </h2>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">Something went wrong.</span>
                        <ul class="mt-3 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-6">
                    <a href="{{ route('chatbots.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Create New Chatbot
                    </a>
                </div>

                @if (isset($chatbots) && count($chatbots) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">LLM Type</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($chatbots as $chatbot)
                                    <tr data-chatbot-id="{{ $chatbot['id'] }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $chatbot['name'] }}</div>
                                            <div class="text-sm text-gray-500">{{ $chatbot['description'] ?? 'No description' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $chatbot['llm_type'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap status-cell" data-status-cell>
                                            @if ($chatbot['is_ready'])
                                                <span class="status-pill px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Ready
                                                </span>
                                            @else
                                                <span class="status-pill px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    <svg class="inline w-4 h-4 mr-1 text-yellow-600 animate-spin" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8z"></path>
                                                    </svg>
                                                    Processing: {{ $chatbot['status_message'] ?? 'Pending' }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($chatbot['updated_at'])->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('chatbots.show', $chatbot['id']) }}" class="text-indigo-600 hover:text-indigo-900">Manage</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600">You haven't created any chatbots yet. Click the button above to get started!</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const userId = "{{ Auth::id() }}";
    const backendUrl = "{{ env('VITE_FLASK_BACKEND_URL') }}";

    if (typeof io !== 'undefined') {
        const socket = io(backendUrl);

        socket.on('connect', () => {
            console.log('Connected to Flask Socket.IO server.');
            socket.emit('join_room', { room: 'user_updates', user_id: userId });
        });

        socket.on('room_joined', (data) => {
            console.log(data.message);
        });

        socket.on('processing_status', (data) => {
            if (data.chatbot_id && data.status && data.message) {
                console.log(`Chatbot ${data.chatbot_id} status: ${data.status} - ${data.message}`);

                const row = document.querySelector(`tr[data-chatbot-id='${data.chatbot_id}']`);
                if (row) {
                    const statusCell = row.querySelector('[data-status-cell]');
                    if (statusCell) {
                        let badgeColor = 'bg-yellow-100 text-yellow-800';
                        let icon = `
                            <svg class="inline w-4 h-4 mr-1 text-yellow-600 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8z"></path>
                            </svg>
                        `;
                        let text = `Processing: ${data.message}`;

                        if (data.status === 'completed') {
                            badgeColor = 'bg-green-100 text-green-800';
                            icon = '';
                            text = 'Ready';
                        } else if (data.status === 'failed') {
                            badgeColor = 'bg-red-100 text-red-800';
                            icon = '';
                            text = `Failed: ${data.message}`;
                        }

                        statusCell.innerHTML = `
                            <span class="status-pill px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${badgeColor}">
                                ${icon}${text}
                            </span>
                        `;
                    }
                }
            }
        });

        socket.on('disconnect', () => {
            console.log('Disconnected from Flask Socket.IO server.');
        });

        socket.on('connect_error', (error) => {
            console.error('Socket.IO connection error:', error);
        });
    } else {
        console.warn("Socket.IO client library not loaded.");
    }
});
</script>
@endsection
