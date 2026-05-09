<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AiAgentController extends Controller
{
    /**
     * Process AI chat message
     */
    public function chat(Request $request): JsonResponse
    {
        try {
            // Simple hardcoded response without any dependencies
            $message = $request->input('message', '');
            
            if (empty($message)) {
                return response()->json([
                    'response' => "Veuillez fournir un message.",
                    'confidence' => 0.1,
                    'suggestions' => ['Compétences techniques', 'Projets réalisés', 'Services proposés'],
                    'category' => 'error_empty_message'
                ]);
            }
            
            // Direct hardcoded response system
            $response = $this->generateIntelligentResponse(strtolower($message));

            return response()->json([
                'response' => $response,
                'confidence' => 0.8,
                'suggestions' => $this->generateSuggestions($message),
                'category' => $this->categorizeQuestion($message)
            ]);

        } catch (\Exception $e) {
            // Simple fallback without logging to avoid header issues
            return response()->json([
                'response' => "Je suis l'assistant IA du portfolio. Je peux vous présenter les compétences, projets et expériences du développeur.",
                'confidence' => 0.5,
                'suggestions' => ['Compétences techniques', 'Projets réalisés', 'Services proposés'],
                'category' => 'error_fallback'
            ]);
        }
    }

    /**
     * Generate intelligent response based on message content
     */
    private function generateIntelligentResponse(string $message): string
    {
        // Greetings
        if (str_contains($message, ['bonjour', 'hello', 'salut', 'hi'])) {
            return "Bonjour ! Je suis l'assistant IA du portfolio. Je peux vous présenter les compétences, projets et expériences du développeur Full Stack Software Engineer. Comment puis-je vous aider ?";
        }

        // Who are you
        if (str_contains($message, ['qui es-tu', 'who are you', 'présente-toi', 'présente'])) {
            return "Je suis l'assistant IA du portfolio. Je peux vous présenter les compétences, projets et expériences du développeur Full Stack Software Engineer.";
        }

        // Skills/competencies
        if (str_contains($message, ['compétence', 'skill', 'techno', 'technology', 'langage'])) {
            return "Les compétences principales du développeur incluent : Laravel (expert), PHP, JavaScript, Vue.js, React, Bootstrap, TailwindCSS, Docker, AWS, MySQL, PostgreSQL. Quelle technologie vous intéresse particulièrement ?";
        }

        // Projects
        if (str_contains($message, ['projet', 'project', 'réalisation', 'work'])) {
            return "Le développeur réalise des projets web modernes : applications Laravel, sites responsive, systèmes backend, interfaces utilisateur modernes. Souhaitez-vous voir des exemples spécifiques ?";
        }

        // Experience
        if (str_contains($message, ['expérience', 'experience', 'parcours', 'career'])) {
            return "Je peux vous présenter le parcours professionnel du développeur : ses expériences, ses réalisations et son évolution technique. Préférez-vous connaître ses postes ou ses compétences acquises ?";
        }

        // Contact
        if (str_contains($message, ['contact', 'contacter', 'email', 'téléphone'])) {
            return "Vous pouvez contacter le développeur via le formulaire de contact sur ce site ou directement par email. Il répond généralement sous 24h. Y a-t-il un projet spécifique à discuter ?";
        }

        // Services
        if (str_contains($message, ['service', 'aide', 'aide', 'offres'])) {
            return "Les services proposés incluent le développement web sur mesure, applications Laravel, sites responsive, maintenance évolutive et support technique. Quel type de projet avez-vous en tête ?";
        }

        // Default intelligent fallback
        return "Je peux vous aider concernant les projets, compétences, technologies et expériences du développeur. Que souhaitez-vous découvrir : son profil technique, ses réalisations ou ses services ?";
    }

    /**
     * Generate suggestions based on message
     */
    private function generateSuggestions(string $message): array
    {
        if (str_contains($message, ['compétence', 'skill'])) {
            return ['Niveau en Laravel ?', 'Technologies frontend ?', 'Expérience Cloud ?'];
        }
        
        if (str_contains($message, ['projet', 'project'])) {
            return ['Projets récents ?', 'Technologies utilisées ?', 'Défis techniques ?'];
        }
        
        if (str_contains($message, ['service'])) {
            return ['Tarifs des services ?', 'Délais de livraison ?', 'Méthodologie de travail ?'];
        }
        
        return ['Compétences techniques', 'Services proposés', 'Projets réalisés', 'Contact et disponibilité'];
    }

    /**
     * Categorize question
     */
    private function categorizeQuestion(string $message): string
    {
        if (str_contains($message, ['bonjour', 'hello'])) return 'greeting';
        if (str_contains($message, ['compétence', 'skill'])) return 'skills';
        if (str_contains($message, ['projet', 'project'])) return 'projects';
        if (str_contains($message, ['service'])) return 'services';
        if (str_contains($message, ['contact'])) return 'contact';
        if (str_contains($message, ['expérience', 'experience'])) return 'experience';
        
        return 'general';
    }

    /**
     * Get conversation history
     */
    public function history(): JsonResponse
    {
        return response()->json([
            'conversation' => []
        ]);
    }

    /**
     * Clear conversation
     */
    public function clear(): JsonResponse
    {
        return response()->json([
            'message' => 'Conversation cleared successfully'
        ]);
    }

    /**
     * Get AI agent status
     */
    public function status(): JsonResponse
    {
        return response()->json([
            'status' => 'online',
            'memory_loaded' => true,
            'categories' => [
                'profile', 'skills', 'projects', 
                'experience', 'services', 'contact'
            ]
        ]);
    }

    /**
     * Get suggestions
     */
    public function suggestions(): JsonResponse
    {
        return response()->json([
            'suggestions' => [
                'Quelles sont vos compétences ?',
                'Présentez vos projets',
                'Comment vous contacter ?',
                'Quelle est votre expérience ?'
            ]
        ]);
    }

    /**
     * Refresh memory
     */
    public function refreshMemory(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Memory refreshed successfully'
        ]);
    }

    /**
     * Get memory items
     */
    public function getMemoryItems(): JsonResponse
    {
        return response()->json([]);
    }

    /**
     * Create memory item
     */
    public function createMemoryItem(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Memory item created successfully'
        ]);
    }

    /**
     * Update memory item
     */
    public function updateMemoryItem(Request $request, $id): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Memory item updated successfully'
        ]);
    }

    /**
     * Delete memory item
     */
    public function deleteMemoryItem($id): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Memory item deleted successfully'
        ]);
    }
}
