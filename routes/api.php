<?php

use App\Http\Controllers\AiAgentController;
use Illuminate\Support\Facades\Route;

// API Routes - NO MIDDLEWARE AT ALL
Route::prefix('ai')->group(function () {
    Route::post('/chat', [AiAgentController::class, 'chat'])->name('ai.chat');
    Route::get('/history', [AiAgentController::class, 'history'])->name('ai.history');
    Route::post('/clear', [AiAgentController::class, 'clear'])->name('ai.clear');
    Route::get('/status', [AiAgentController::class, 'status'])->name('ai.status');
    Route::get('/suggestions', [AiAgentController::class, 'suggestions'])->name('ai.suggestions');
    Route::post('/refresh-memory', [AiAgentController::class, 'refreshMemory'])->name('ai.refresh');
    Route::get('/memory-items', [AiAgentController::class, 'getMemoryItems'])->name('ai.memory.items');
    Route::post('/memory-items', [AiAgentController::class, 'createMemoryItem'])->name('ai.memory.create');
    Route::put('/memory-items/{id}', [AiAgentController::class, 'updateMemoryItem'])->name('ai.memory.update');
    Route::delete('/memory-items/{id}', [AiAgentController::class, 'deleteMemoryItem'])->name('ai.memory.delete');
});

// Simple test route
Route::get('/test-simple', function () {
    return response()->json([
        'message' => 'Test route working',
        'status' => 'success'
    ]);
});
