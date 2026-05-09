<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\AiAgentController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

// Test AI Route
Route::get('/api/test-ai', function () {
    return response()->json([
        'status' => 'test_route_working',
        'message' => 'Test route is accessible',
        'timestamp' => now()->toISOString(),
        'controller_loaded' => class_exists('App\\Http\\Controllers\\AiAgentController'),
        'method' => 'GET'
    ]);
});

// Remove AI routes from web.php - they're now in api.php

// All admin routes require authentication
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return redirect('/dashboard');
        });
        
        Route::resource('projects', ProjectController::class)->except(['show', 'create']);
        Route::resource('certificates', CertificateController::class)->except(['show', 'create']);
        Route::resource('testimonials', TestimonialController::class)->except(['show', 'create']);
        Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
        
        // AI Agent Management
        Route::get('ai-agent', function () {
            return view('admin.ai-agent.index');
        })->name('ai-agent.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
