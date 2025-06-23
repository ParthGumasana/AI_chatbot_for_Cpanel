<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    protected $flaskBackendUrl;
    protected $flaskApiKey;

    public function __construct()
    {
        // $this->middleware('auth'); // Uncomment if you want to apply auth middleware to all methods
        $this->flaskBackendUrl = env('VITE_FLASK_BACKEND_URL');
        $this->flaskApiKey = env('FLASK_BACKEND_API_KEY');
    }

    public function create()
    {
        return view('chatbots.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'llm_type' => 'required|in:LM_STUDIO,OPENAI',
            'openai_api_key' => 'nullable|string|required_if:llm_type,OPENAI',
        ]);

        try {
            $user_id = Auth::id(); // Get the authenticated Laravel user's ID

            $response = Http::withHeaders([
                'X-Api-Key' => $this->flaskApiKey
            ])->asForm()->post("{$this->flaskBackendUrl}/api/create_chatbot", [
                'user_id' => $user_id, // Pass user ID to Flask backend
                'name' => $request->name,
                'description' => $request->description,
                'llm_type' => $request->llm_type,
                'openai_api_key' => $request->openai_api_key,
            ]);

            if ($response->successful()) {
                $chatbotData = $response->json();
                return redirect()->route('chatbots.show', ['id' => $chatbotData['chatbot_id']])
                                 ->with('success', 'Chatbot created successfully! You can now upload data.');
            } else {
                Log::error('Flask API Error (create_chatbot): ' . $response->body());
                return back()->withInput()->withErrors(['api_error' => $response->json()['detail'] ?? 'Failed to create chatbot.']);
            }
        } catch (\Exception $e) {
            Log::error('Chatbot creation exception: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'An unexpected error occurred: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        // The embedUrl will include the Flask backend URL, chatbot ID, and the owner's user ID
        $user_id = Auth::id();
        $embedUrl = "{$this->flaskBackendUrl}/embed/{$id}?ownerId={$user_id}";
        return view('chatbots.show', compact('id', 'embedUrl'));
    }

    public function uploadData(Request $request, $id)
    {
        $request->validate([
            'files.*' => 'nullable|file|max:16384', // Max 16MB per file
            'urls.*' => 'nullable|url',
        ]);

        if (empty($request->file('files')) && empty($request->input('urls'))) {
            return back()->withErrors(['data_error' => 'Please provide at least one file or URL.']);
        }

        try {
            $user_id = Auth::id(); // Get the authenticated Laravel user's ID

            $multipartData = [
                ['name' => 'user_id', 'contents' => $user_id], // Pass user_id as a form field
            ];
            
            // Add files to multipart request
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $multipartData[] = [
                        'name' => 'files[]',
                        'contents' => fopen($file->getPathname(), 'r'),
                        'filename' => $file->getClientOriginalName(),
                        'headers' => ['Content-Type' => $file->getMimeType()]
                    ];
                }
            }
            // Add URLs to multipart request
            if ($request->has('urls')) {
                // Ensure 'urls' is an array before iterating
                // The provided blade uses a textarea, so it will be a single string unless split.
                // Assuming it's a string with newlines for now.
                $urls = is_array($request->input('urls')) ? $request->input('urls') : explode("\n", $request->input('urls'));
                foreach ($urls as $url) {
                    $url = trim($url);
                    if (!empty($url)) {
                        $multipartData[] = ['name' => 'urls[]', 'contents' => $url];
                    }
                }
            }
            
            $response = Http::withHeaders([
                'X-Api-Key' => $this->flaskApiKey
            ])->attach($multipartData)->post("{$this->flaskBackendUrl}/api/update_chatbot_data/{$id}");

            if ($response->successful()) {
                return back()->with('success', 'Data upload initiated. Chatbot will be ready shortly.');
            } else {
                Log::error('Flask API Error (upload_data): ' . $response->body());
                return back()->withErrors(['api_error' => $response->json()['detail'] ?? 'Failed to upload data.']);
            }
        } catch (\Exception $e) {
            Log::error('Data upload exception: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An unexpected error occurred: ' . $e->getMessage()]);
        }
    }

    // NEW: Handle chatbot deletion.
    /**
     * Handle chatbot deletion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id  The ID of the chatbot to delete.
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user_id = Auth::id(); // Get the authenticated Laravel user's ID

            // Make a DELETE request to your Flask backend
            $response = Http::withHeaders([
                'X-Api-Key' => $this->flaskApiKey
            ])->delete("{$this->flaskBackendUrl}/api/delete_chatbot/{$id}", [
                'user_id' => $user_id, // Pass user ID to Flask for authorization/ownership check
            ]);

            if ($response->successful()) {
                return redirect()->route('dashboard')->with('success', 'Chatbot deleted successfully.');
            } else {
                // Log the full Flask response for debugging
                Log::error('Flask API Error (delete_chatbot): ' . $response->body());
                
                // Attempt to get a more specific error message from Flask's response
                $errorMessage = $response->json()['detail'] ?? 'Failed to delete chatbot.';
                return back()->withErrors(['api_error' => $errorMessage]);
            }
        } catch (\Exception $e) {
            Log::error('Chatbot deletion exception: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An unexpected error occurred: ' . $e->getMessage()]);
        }
    }
}