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
            $response = Http::withHeaders([
                'X-Api-Key' => $this->flaskApiKey
            ])->get("{$this->flaskBackendUrl}/admin/handoffs");

            if ($response->successful()) {
                $handoffRequests = $response->json();
                return view('admin.handoffs', compact('handoffRequests'));
            } else {
                Log::error('Flask API Error (admin/handoffs): ' . $response->body());
                return view('admin.handoffs')->withErrors(['api_error' => $response->json()['detail'] ?? 'Failed to load handoff requests.']);
            }
        } catch (\Exception $e) {
            Log::error('Admin handoffs exception: ' . $e->getMessage());
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
