<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    protected $flaskBackendUrl;
    protected $flaskApiKey;

    public function __construct()
    {
        // $this->middleware('auth');
        // IMPORTANT: In a real app, you MUST implement an 'admin' middleware
        // that checks if the authenticated Laravel user has admin privileges.
        // For this demo, any authenticated user can view admin handoffs.
        // $this->middleware('admin'); 
        $this->flaskBackendUrl = env('VITE_FLASK_BACKEND_URL');
        $this->flaskApiKey = env('FLASK_BACKEND_API_KEY');
    }

    public function showHandoffs()
    {
        try {
            $user_id = Auth::id();
            $is_admin = true; // Temporarily set to true for testing - change back to: Auth::user()->is_admin ?? false;
            
            // Determine which endpoint to use based on user role
            if ($is_admin) {
                // Admin sees all handoffs
                $response = Http::withHeaders([
                    'X-Api-Key' => $this->flaskApiKey
                ])->get("{$this->flaskBackendUrl}/admin/handoffs");
            } else {
                // Regular user sees only their handoffs using the existing admin endpoint
                // The backend will filter by user_id automatically
                $response = Http::withHeaders([
                    'X-Api-Key' => $this->flaskApiKey
                ])->get("{$this->flaskBackendUrl}/admin/handoffs?user_id={$user_id}");
            }

            if ($response->successful()) {
                $handoffRequests = $response->json();
                
                // Use different views based on user role
                if ($is_admin) {
                    return view('admin.handoffs', compact('handoffRequests', 'is_admin'));
                } else {
                    return view('admin.handoffs', compact('handoffRequests', 'is_admin')); // Use same view for now
                }
            } else {
                Log::error('Flask API Error (handoffs): ' . $response->body());
                return view('admin.handoffs')->withErrors(['api_error' => $response->json()['detail'] ?? 'Failed to load handoff requests.']);
            }
        } catch (\Exception $e) {
            Log::error('Handoffs exception: ' . $e->getMessage());
            return view('admin.handoffs')->withErrors(['error' => 'An unexpected error occurred: ' . $e->getMessage()]);
        }
    }

    public function resolveHandoff(Request $request, $id)
    {
        try {
            $response = Http::withHeaders([
                'X-Api-Key' => $this->flaskApiKey
            ])->post("{$this->flaskBackendUrl}/admin/handoffs/{$id}/resolve");

            if ($response->successful()) {
                return back()->with('success', 'Handoff request marked as resolved.');
            } else {
                Log::error('Flask API Error (resolve_handoff): ' . $response->body());
                return back()->withErrors(['api_error' => $response->json()['detail'] ?? 'Failed to resolve handoff request.']);
            }
        } catch (\Exception $e) {
            Log::error('Handoff resolution exception: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An unexpected error occurred: ' . $e->getMessage()]);
        }
    }
}
