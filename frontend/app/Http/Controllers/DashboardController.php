<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $flaskBackendUrl;
    protected $flaskApiKey;

    public function __construct()
    {
        // $this->middleware('auth'); // Laravel's built-in authentication
        $this->flaskBackendUrl = env('VITE_FLASK_BACKEND_URL');
        $this->flaskApiKey = env('FLASK_BACKEND_API_KEY');
    }

    public function index(Request $request)
    {
        try {
            $user_id = Auth::id(); // Get the authenticated Laravel user's ID (typically UUID or int)

            // Make authenticated request to Flask backend using X-Api-Key header
            $response = Http::withHeaders([
                'X-Api-Key' => $this->flaskApiKey
            ])->get("{$this->flaskBackendUrl}/api/chatbots/{$user_id}"); // Pass user ID in URL

            if ($response->successful()) {
                $chatbots = $response->json();
                
                // Fetch analytics data for each chatbot
                $analyticsData = $this->getAnalyticsData($chatbots);
                
                return view('dashboard', compact('chatbots', 'analyticsData'));
            } else {
                Log::error('Flask API Error (get_user_chatbots): ' . $response->body());
                return view('dashboard')->withErrors(['api_error' => $response->json()['detail'] ?? 'Failed to load chatbots from backend.']);
            }
        } catch (\Exception $e) {
            Log::error('Dashboard chatbot load exception: ' . $e->getMessage());
            return view('dashboard')->withErrors(['error' => 'An unexpected error occurred while loading chatbots: ' . $e->getMessage()]);
        }
    }

    private function getAnalyticsData($chatbots)
    {
        $analyticsData = [
            'totalChats' => 0,
            'avgResponseTime' => '0s',
            'activeSessions' => 0,
            'pendingHandoffs' => 0,
            'usageData' => [
                'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                'data' => [0, 0, 0, 0, 0, 0, 0]
            ],
            'chatbotAnalytics' => []
        ];

        try {
            $user_id = Auth::id();

            // Get user-specific analytics
            $userAnalyticsResponse = Http::withHeaders([
                'X-Api-Key' => $this->flaskApiKey
            ])->get("{$this->flaskBackendUrl}/api/user_analytics/{$user_id}");

            if ($userAnalyticsResponse->successful()) {
                $userAnalytics = $userAnalyticsResponse->json();
                $analyticsData['totalChats'] = $userAnalytics['total_interactions'] ?? 0;
                $analyticsData['activeSessions'] = $userAnalytics['active_sessions'] ?? 0;
                $analyticsData['activeChatbotCount'] = $userAnalytics['active_chatbot_count'] ?? 0;
            }

            // Get health check data for pending handoffs
            $healthResponse = Http::withHeaders([
                'X-Api-Key' => $this->flaskApiKey
            ])->get("{$this->flaskBackendUrl}/health_check");

            if ($healthResponse->successful()) {
                $healthData = $healthResponse->json();
                $analyticsData['pendingHandoffs'] = $healthData['pending_handoffs'] ?? 0;
            }

            // Get individual chatbot analytics for detailed view
            foreach ($chatbots as $chatbot) {
                $chatbotAnalyticsResponse = Http::withHeaders([
                    'X-Api-Key' => $this->flaskApiKey
                ])->get("{$this->flaskBackendUrl}/api/chatbot_analytics/{$chatbot['id']}");

                if ($chatbotAnalyticsResponse->successful()) {
                    $chatbotAnalytics = $chatbotAnalyticsResponse->json();
                    $analyticsData['chatbotAnalytics'][$chatbot['id']] = $chatbotAnalytics;
                }
            }

            // Calculate average response time (placeholder - you can enhance this)
            if (count($chatbots) > 0) {
                $analyticsData['avgResponseTime'] = '2.3s'; // This could be calculated from actual response times
            }

            // Generate mock usage data for the last 7 days (you can replace this with real data)
            $analyticsData['usageData']['data'] = $this->generateMockUsageData();

        } catch (\Exception $e) {
            Log::error('Analytics data fetch exception: ' . $e->getMessage());
            // Return default data if analytics fetch fails
        }

        return $analyticsData;
    }

    private function generateMockUsageData()
    {
        // Generate realistic mock data for the last 7 days
        $data = [];
        for ($i = 0; $i < 7; $i++) {
            $data[] = rand(20, 100); // Random number between 20-100 chats per day
        }
        return $data;
    }
}
