@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Analytics Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Active Chatbot Analytics</h2>
                <span class="text-sm text-gray-500 bg-blue-50 px-3 py-1 rounded-full">
                    Only active chatbots
                </span>
            </div>
            <div class="mb-4 text-sm text-gray-600">
                Analyzing data from <span class="font-medium" id="active-chatbot-count">0</span> active chatbot(s)
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Chats Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Chats</dt>
                                    <dd class="text-lg font-medium text-gray-900" id="total-chats">Loading...</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Average Response Time Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Avg Response Time</dt>
                                    <dd class="text-lg font-medium text-gray-900" id="avg-response-time">Loading...</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Sessions Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Active Sessions</dt>
                                    <dd class="text-lg font-medium text-gray-900" id="active-sessions">Loading...</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Handoffs Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Pending Handoffs</dt>
                                    <dd class="text-lg font-medium text-gray-900" id="pending-handoffs">Loading...</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usage Chart -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Chat Usage (Last 7 Days)</h3>
                    <div class="h-64">
                        <canvas id="usageChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chatbots Section -->
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
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        LLM Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Last Updated
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($chatbots as $chatbot)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $chatbot['name'] }}</div>
                                            <div class="text-sm text-gray-500">{{ $chatbot['description'] ?? 'No description' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $chatbot['llm_type'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($chatbot['is_ready'])
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Ready
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
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

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php
$defaultAnalyticsData = [
    'totalChats' => 0,
    'avgResponseTime' => '0s',
    'activeSessions' => 0,
    'pendingHandoffs' => 0,
    'usageData' => [
        'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        'data' => [0, 0, 0, 0, 0, 0, 0]
    ]
];
@endphp

<script>
    // Analytics Data Loading
    document.addEventListener('DOMContentLoaded', function() {
        loadAnalytics();
        setupSocketIO();
    });

    function loadAnalytics() {
        // Use real analytics data from the backend
        const analyticsData = @json($analyticsData ?? $defaultAnalyticsData);

        // Update metrics cards
        document.getElementById('total-chats').textContent = analyticsData.totalChats.toLocaleString();
        document.getElementById('avg-response-time').textContent = analyticsData.avgResponseTime;
        document.getElementById('active-sessions').textContent = analyticsData.activeSessions;
        document.getElementById('pending-handoffs').textContent = analyticsData.pendingHandoffs;
        document.getElementById('active-chatbot-count').textContent = analyticsData.activeChatbotCount || 0;

        // Create usage chart
        const ctx = document.getElementById('usageChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: analyticsData.usageData.labels,
                datasets: [{
                    label: 'Chats',
                    data: analyticsData.usageData.data,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    function setupSocketIO() {
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
                    location.reload();
                }
            });

            socket.on('disconnect', () => {
                console.log('Disconnected from Flask Socket.IO server.');
            });

            socket.on('connect_error', (error) => {
                console.error('Socket.IO connection error:', error);
            });
        } else {
            console.warn("Socket.IO client library not loaded. Real-time updates will not work.");
        }
    }
</script>
@endsection
