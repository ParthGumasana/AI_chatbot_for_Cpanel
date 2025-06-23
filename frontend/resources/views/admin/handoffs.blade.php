@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    Human Handoff Requests
                </h2>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">Something went wrong.</span>
                        <ul class="mt-3 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (isset($handoffRequests) && count($handoffRequests) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Chatbot ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        User Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Summary
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Requested At
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($handoffRequests as $request)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ substr($request['id'], 0, 8) }}...</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ substr($request['chatbot_id'], 0, 8) }}...</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $request['user_email'] }}</div>
                                            @if ($request['user_name'])
                                                <div class="text-xs text-gray-500">Name: {{ $request['user_name'] }}</div>
                                            @endif
                                            @if ($request['user_phone'])
                                                <div class="text-xs text-gray-500">Phone: {{ $request['user_phone'] }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $request['summary'] }}</div>
                                            <button onclick="toggleHistory('{{ $request['id'] }}')" class="text-xs text-blue-600 hover:text-blue-900 mt-1">View Full History</button>
                                            <div id="history-{{ $request['id'] }}" class="hidden text-xs text-gray-700 bg-gray-50 p-2 rounded-md mt-2 max-h-40 overflow-y-auto">
                                                @foreach ($request['query_history'] as $message)
                                                    <p><strong>{{ ucfirst($message['role']) }}:</strong> {{ $message['content'] }}</p>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($request['status'] == 'pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @elseif ($request['status'] == 'resolved')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Resolved
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ ucfirst($request['status']) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($request['created_at'])->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if ($request['status'] == 'pending')
                                                <form action="{{ route('admin.handoffs.resolve', $request['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this as resolved?');">
                                                    @csrf
                                                    <button type="submit" class="text-indigo-600 hover:text-indigo-900">Resolve</button>
                                                </form>
                                            @else
                                                <span class="text-gray-400">No Action</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600">No human handoff requests at this time.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function toggleHistory(id) {
        const historyDiv = document.getElementById('history-' + id);
        historyDiv.classList.toggle('hidden');
    }

    // Socket.IO for real-time updates for admins
    document.addEventListener('DOMContentLoaded', function() {
        const backendUrl = "{{ env('VITE_FLASK_BACKEND_URL') }}";

        if (typeof io !== 'undefined') {
            const socket = io(backendUrl);

            socket.on('connect', () => {
                console.log('Admin connected to Flask Socket.IO server.');
                // Join the 'admins' room to receive notifications
                socket.emit('join_room', { room: 'admins' });
            });

            socket.on('room_joined', (data) => {
                console.log(data.message);
            });

            socket.on('new_handoff_request', (data) => {
                console.log('New Handoff Request:', data);
                // Trigger a page reload or dynamically update the table
                alert(`New Handoff Request for Chatbot: ${data.chatbot_id} from ${data.user_email}!`);
                location.reload(); // Simple reload for demonstration, consider partial updates
            });

            socket.on('disconnect', () => {
                console.log('Admin disconnected from Flask Socket.IO server.');
            });

            socket.on('connect_error', (error) => {
                console.error('Socket.IO connection error:', error);
            });
        } else {
            console.warn("Socket.IO client library not loaded. Real-time updates for admins will not work.");
        }
    });
</script>
@endsection
