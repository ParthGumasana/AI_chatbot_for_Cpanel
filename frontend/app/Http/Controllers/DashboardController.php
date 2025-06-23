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
                return view('dashboard', compact('chatbots'));
            } else {
                Log::error('Flask API Error (get_user_chatbots): ' . $response->body());
                return view('dashboard')->withErrors(['api_error' => $response->json()['detail'] ?? 'Failed to load chatbots from backend.']);
            }
        } catch (\Exception $e) {
            Log::error('Dashboard chatbot load exception: ' . $e->getMessage());
            return view('dashboard')->withErrors(['error' => 'An unexpected error occurred while loading chatbots: ' . $e->getMessage()]);
        }
    }
}
