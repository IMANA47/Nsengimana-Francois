<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AiAgentController extends Controller
{
    public function chat(Request $request): JsonResponse
    {
        $message = $request->input('message', '');
        
        if (empty($message)) {
            return response()->json([
                'response' => "Veuillez fournir un message."
            ]);
        }
        
        // Simple hardcoded responses
        $message = strtolower($message);
        
        if (strpos($message, 'bonjour') !== false || strpos($message, 'hello') !== false) {
            return response()->json([
                'response' => "Bonjour ! Je suis l'assistant IA du portfolio."
            ]);
        }
        
        if (strpos($message, 'compétence') !== false || strpos($message, 'skill') !== false) {
            return response()->json([
                'response' => "Les compétences incluent : Laravel, PHP, JavaScript, Vue.js, React."
            ]);
        }
        
        if (strpos($message, 'projet') !== false || strpos($message, 'project') !== false) {
            return response()->json([
                'response' => "Je réalise des projets web modernes avec Laravel et JavaScript."
            ]);
        }
        
        if (strpos($message, 'qui es-tu') !== false || strpos($message, 'who are you') !== false) {
            return response()->json([
                'response' => "Je suis l'assistant IA du portfolio."
            ]);
        }
        
        return response()->json([
            'response' => "Je peux vous aider avec les compétences, projets et services du développeur."
        ]);
    }
    
    public function history(): JsonResponse
    {
        return response()->json(['conversation' => []]);
    }
    
    public function clear(): JsonResponse
    {
        return response()->json(['message' => 'Conversation cleared']);
    }
    
    public function status(): JsonResponse
    {
        return response()->json(['status' => 'online']);
    }
    
    public function suggestions(): JsonResponse
    {
        return response()->json(['suggestions' => ['Compétences', 'Projets', 'Contact']]);
    }
    
    public function refreshMemory(): JsonResponse
    {
        return response()->json(['success' => true]);
    }
    
    public function getMemoryItems(): JsonResponse
    {
        return response()->json([]);
    }
    
    public function createMemoryItem(Request $request): JsonResponse
    {
        return response()->json(['success' => true]);
    }
    
    public function updateMemoryItem(Request $request, $id): JsonResponse
    {
        return response()->json(['success' => true]);
    }
    
    public function deleteMemoryItem($id): JsonResponse
    {
        return response()->json(['success' => true]);
    }
}
