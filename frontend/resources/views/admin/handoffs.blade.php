@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        @if($is_admin ?? false)
                            Human Handoff Requests
                        @else
                            Your Chatbot Handoffs
                        @endif
                    </h2>
                    @if(!($is_admin ?? false))
                        <span class="text-sm text-gray-500 bg-blue-50 px-3 py-1 rounded-full">
                            Your chatbots only
                        </span>
                    @endif
                </div>

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
                                                <div class="flex space-x-2">
                                                    <button onclick="engageChat('{{ $request['id'] }}', '{{ $request['session_id'] }}', '{{ $request['user_email'] }}')" 
                                                            class="text-green-600 hover:text-green-900">
                                                        Engage Chat
                                                    </button>
                                                    <form action="{{ ($is_admin ?? false) ? route('admin.handoffs.resolve', $request['id']) : route('handoffs.resolve', $request['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this as resolved?');">
                                                        @csrf
                                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">Resolve</button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-gray-400">No actions</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600">
                        @if($is_admin ?? false)
                            No human handoff requests at this time.
                        @else
                            No handoff requests have been made for your chatbots yet.
                        @endif
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Chat Modal -->
<div id="chatModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="chatModalTitle">Chat with User</h3>
                <button onclick="closeChatModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Chat Messages -->
            <div id="chatMessages" class="h-64 overflow-y-auto border rounded-lg p-4 mb-4 bg-gray-50">
                <div class="text-center text-gray-500">Chat messages will appear here...</div>
            </div>
            
            <!-- Message Input -->
            <div class="flex space-x-2">
                <input type="text" id="messageInput" placeholder="Type your message..." 
                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button onclick="sendMessage()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Send
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentSessionId = null;
    let currentHandoffId = null;
    let socket = null;

    function toggleHistory(id) {
        const historyDiv = document.getElementById('history-' + id);
        historyDiv.classList.toggle('hidden');
    }

    function engageChat(handoffId, sessionId, userEmail) {
        currentSessionId = sessionId;
        currentHandoffId = handoffId;
        
        // Update modal title
        document.getElementById('chatModalTitle').textContent = `Chat with ${userEmail}`;
        
        // Clear previous messages
        document.getElementById('chatMessages').innerHTML = '<div class="text-center text-gray-500">Loading chat...</div>';
        
        // Show modal
        document.getElementById('chatModal').classList.remove('hidden');
        
        // Initialize Socket.IO connection
        initializeSocketIO();
        
        // Load existing messages
        loadExistingMessages(handoffId);
        
        // Join the handoff chat room
        if (socket) {
            socket.emit('join_handoff_chat_room', {
                handoff_id: handoffId,
                session_id: sessionId
            });
        }
    }

    function loadExistingMessages(handoffId) {
        const backendUrl = "{{ env('VITE_FLASK_BACKEND_URL') }}";
        const apiKey = "{{ env('FLASK_BACKEND_API_KEY') }}";
        
        fetch(`${backendUrl}/api/handoff/${handoffId}/messages`, {
            method: 'GET',
            headers: {
                'X-Api-Key': apiKey,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(messages => {
            const chatMessages = document.getElementById('chatMessages');
            chatMessages.innerHTML = '';
            
            if (messages && messages.length > 0) {
                messages.forEach(msg => {
                    addMessageToChat(
                        msg.sender_type === 'agent' ? 'You' : 'User',
                        msg.message_content,
                        msg.sender_type
                    );
                });
            } else {
                chatMessages.innerHTML = '<div class="text-center text-gray-500">No previous messages</div>';
            }
        })
        .catch(error => {
            console.error('Error loading messages:', error);
            document.getElementById('chatMessages').innerHTML = '<div class="text-center text-red-500">Error loading messages</div>';
        });
    }

    function closeChatModal() {
        document.getElementById('chatModal').classList.add('hidden');
        currentSessionId = null;
        currentHandoffId = null;
        
        // Leave the chat room
        if (socket) {
            socket.emit('leave_handoff_chat_room', {
                handoff_id: currentHandoffId,
                session_id: currentSessionId
            });
        }
    }

    function sendMessage() {
        const messageInput = document.getElementById('messageInput');
        const message = messageInput.value.trim();
        
        if (!message || !currentSessionId) return;
        
        // Send message via Socket.IO
        if (socket) {
            socket.emit('admin_send_message', {
                session_id: currentSessionId,
                message: message
            });
        }
        
        // Clear input
        messageInput.value = '';
    }

    function initializeSocketIO() {
        if (socket) return; // Already initialized
        
        const backendUrl = "{{ env('VITE_FLASK_BACKEND_URL') }}";
        
        if (typeof io !== 'undefined') {
            socket = io(backendUrl);
            
            socket.on('connect', () => {
                console.log('Connected to Flask Socket.IO server for chat.');
            });
            
            socket.on('chat_response', (data) => {
                if (data.is_agent_response) {
                    // This is a message from the agent (us)
                    addMessageToChat('You', data.answer, 'agent');
                } else {
                    // This is a message from the user
                    addMessageToChat('User', data.answer, 'user');
                }
            });
            
            socket.on('handoff_message', (data) => {
                // Handle handoff-specific messages
                addMessageToChat(data.sender_type === 'agent' ? 'You' : 'User', data.message_content, data.sender_type);
            });
            
            socket.on('initial_handoff_chat_history', (data) => {
                const chatMessages = document.getElementById('chatMessages');
                chatMessages.innerHTML = '';
                
                if (data.history && data.history.length > 0) {
                    data.history.forEach(msg => {
                        addMessageToChat(
                            msg.role === 'bot' ? 'You' : 'User',
                            msg.content,
                            msg.role === 'bot' ? 'agent' : 'user'
                        );
                    });
                } else {
                    chatMessages.innerHTML = '<div class="text-center text-gray-500">No previous messages</div>';
                }
            });
            
            socket.on('disconnect', () => {
                console.log('Disconnected from Flask Socket.IO server.');
            });
            
            socket.on('connect_error', (error) => {
                console.error('Socket.IO connection error:', error);
            });
            
            socket.on('admin_message_error', (data) => {
                console.error('Admin message error:', data);
                alert('Error sending message: ' + data.error);
            });
            
        } else {
            console.warn("Socket.IO client library not loaded. Chat functionality will not work.");
        }
    }

    function addMessageToChat(sender, message, type) {
        const chatMessages = document.getElementById('chatMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `mb-3 ${type === 'agent' ? 'text-right' : 'text-left'}`;
        
        const bubbleClass = type === 'agent' 
            ? 'bg-blue-600 text-white inline-block rounded-lg px-3 py-2 max-w-xs'
            : 'bg-gray-300 text-gray-800 inline-block rounded-lg px-3 py-2 max-w-xs';
        
        messageDiv.innerHTML = `
            <div class="${bubbleClass}">
                <div class="text-sm font-medium">${sender}</div>
                <div class="text-sm">${message}</div>
            </div>
        `;
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Handle Enter key in message input
    document.addEventListener('DOMContentLoaded', function() {
        const messageInput = document.getElementById('messageInput');
        if (messageInput) {
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        }
    });

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
