<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController; // For registration
use App\Http\Controllers\Auth\AuthenticatedSessionController; // For login
use Illuminate\Support\Facades\Http; // Added for the register_user_backend call
use Illuminate\Support\Facades\Log; // Make sure Log facade is imported
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains contains the "web" middleware group. Now create something great!
|
*/

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication Routes (using Laravel Breeze for example)
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', function (Request $request) {
    // Breeze's default registration logic
    $response = (new RegisteredUserController)->store($request);

    // After Laravel registers the user in its DB, register them in the Flask backend's MySQL users table
    if ($request->user()) {
        try {
            $flaskBackendUrl = env('VITE_FLASK_BACKEND_URL');
            $flaskApiKey = env('FLASK_BACKEND_API_KEY'); // Assuming this is defined in .env

            Http::withHeaders([
                'X-Api-Key' => $flaskApiKey
            ])->asForm()->post("{$flaskBackendUrl}/api/register_user", [
                'uid' => $request->user()->id, // Assuming Laravel user ID is used as uid in Flask
                'email' => $request->user()->email,
            ])->throw(); // Throws an exception for 4xx or 5xx responses
            
        } catch (\Exception $e) {
            // Log the error but don't prevent user registration in Laravel
            Log::error('Failed to register user in Flask backend: ' . $e->getMessage());
            // Optionally, you could return an error to the user or invalidate Laravel registration
            return back()->withInput()->withErrors(['flask_registration_error' => 'Failed to synchronize user with backend. Please try again.']);
        }
    }
    return $response;
})->middleware('guest');


Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/chatbots/create', [ChatbotController::class, 'create'])->name('chatbots.create');
    Route::post('/chatbots/store', [ChatbotController::class, 'store'])->name('chatbots.store');
    Route::get('/chatbots/{id}', [ChatbotController::class, 'show'])->name('chatbots.show');
    Route::put('/chatbots/{id}', [ChatbotController::class, 'update'])->name('chatbots.update');
    Route::post('/chatbots/{id}/upload-data', [ChatbotController::class, 'uploadData'])->name('chatbots.uploadData');
    Route::put('/chatbots/{id}/update-sources', [ChatbotController::class, 'updateSources'])->name('chatbots.update-sources');
    
    // NEW: Delete Chatbot Route
    Route::delete('/chatbots/{id}', [ChatbotController::class, 'destroy'])->name('chatbots.destroy');
});

// Admin Panel (requires admin role - you will need to create 'admin' middleware)
// Example: Route::middleware(['auth', 'admin'])->group(function () {
Route::middleware(['auth'])->group(function () { // Simplified for demo, add 'admin' middleware in production
    Route::get('/admin/handoffs', [AdminController::class, 'showHandoffs'])->name('admin.handoffs');
    Route::post('/admin/handoffs/{id}/resolve', [AdminController::class, 'resolveHandoff'])->name('admin.handoffs.resolve');
});