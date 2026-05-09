<?php

namespace App\Services;

use Illuminate\Support\Str;

class AiResponseManager
{
    private array $fallbackResponses;
    private array $personalityRules;
    private array $contextualResponses;

    public function __construct()
    {
        $this->initializeFallbackResponses();
        $this->initializePersonalityRules();
        $this->initializeContextualResponses();
    }

    /**
     * Generate intelligent fallback response based on context
     */
    public function generateFallbackResponse(string $question, string $errorType = 'default'): string
    {
        // Analyze question keywords for context
        $context = $this->analyzeContext($question);
        
        // Select appropriate fallback based on error type and context
        $response = match($errorType) {
            'api_failure' => $this->generateApiFailureResponse($context),
            'empty_response' => $this->generateEmptyResponse($context),
            'not_understood' => $this->generateNotUnderstoodResponse($context),
            'technical_error' => $this->generateTechnicalErrorResponse($context),
            default => $this->generateDefaultFallbackResponse($context)
        };

        return $this->applyPersonalityRules($response);
    }

    /**
     * Analyze question context using keywords
     */
    private function analyzeContext(string $question): array
    {
        $question = strtolower($question);
        $context = [];

        // Identify user type
        if (Str::contains($question, ['recruteur', 'recruiter', 'recrutement', 'hiring', 'job'])) {
            $context['user_type'] = 'recruiter';
        } elseif (Str::contains($question, ['client', 'projet', 'project', 'prix', 'price', 'coût'])) {
            $context['user_type'] = 'client';
        } else {
            $context['user_type'] = 'visitor';
        }

        // Identify topic
        if (Str::contains($question, ['compétence', 'skill', 'techno', 'technology', 'langage'])) {
            $context['topic'] = 'skills';
        } elseif (Str::contains($question, ['projet', 'project', 'réalisation', 'work'])) {
            $context['topic'] = 'projects';
        } elseif (Str::contains($question, ['expérience', 'experience', 'parcours', 'career'])) {
            $context['topic'] = 'experience';
        } elseif (Str::contains($question, ['contact', 'contacter', 'email', ' téléphone'])) {
            $context['topic'] = 'contact';
        } elseif (Str::contains($question, ['qui', 'who', 'es-tu', 'présente'])) {
            $context['topic'] = 'introduction';
        } else {
            $context['topic'] = 'general';
        }

        // Identify intent
        if (Str::contains($question, ['?']) || Str::contains($question, ['comment', 'how', 'pourquoi', 'why'])) {
            $context['intent'] = 'question';
        } else {
            $context['intent'] = 'statement';
        }

        return $context;
    }

    /**
     * Generate response for API failure
     */
    private function generateApiFailureResponse(array $context): string
    {
        $responses = [
            'recruiter' => "Le système IA principal est momentanément indisponible, mais je peux vous présenter les informations essentielles du profil du développeur. Souhaitez-vous découvrir ses compétences techniques, ses projets récents ou son expérience professionnelle ?",
            
            'client' => "Je rencontre une difficulté technique temporaire, mais je peux tout de même vous présenter les services et réalisations du développeur. Intéressé par ses compétences en Laravel, ses projets web ou ses tarifs ?",
            
            'visitor' => "Le système IA est momentanément indisponible. Néanmoins, je peux vous présenter le portfolio : compétences en développement web, projets réalisés, et technologies maîtrisées. Que souhaitez-vous découvrir ?"
        ];

        return $responses[$context['user_type']] ?? $responses['visitor'];
    }

    /**
     * Generate response for empty response
     */
    private function generateEmptyResponse(array $context): string
    {
        $responses = [
            'skills' => "Je peux vous détailler les compétences techniques du développeur : Laravel (expert), PHP, JavaScript, Vue.js, React, Bootstrap, TailwindCSS, Docker, AWS. Quelle technologie vous intéresse particulièrement ?",
            
            'projects' => "Le développeur a réalisé de nombreux projets web modernes : applications Laravel, sites responsive, systèmes backend, interfaces utilisateur. Souhaitez-vous voir des exemples spécifiques ?",
            
            'experience' => "Je peux vous présenter le parcours professionnel du développeur : ses expériences, ses réalisations et son évolution technique. Préférez-vous connaître ses postes ou ses compétences acquises ?",
            
            'contact' => "Vous pouvez contacter le développeur via le formulaire de contact sur ce site ou directement par email. Il répond généralement sous 24h. Y a-t-il un projet spécifique à discuter ?",
            
            'introduction' => "Je suis l'assistant IA du portfolio. Je peux vous présenter les compétences, projets et expériences du développeur Full Stack. Comment puis-je vous aider ?",
            
            'general' => "Je peux vous aider concernant les projets, compétences, technologies et expériences du développeur. Que souhaitez-vous découvrir : son profil technique, ses réalisations ou ses services ?"
        ];

        return $responses[$context['topic']] ?? $responses['general'];
    }

    /**
     * Generate response when question is not understood
     */
    private function generateNotUnderstoodResponse(array $context): string
    {
        $responses = [
            'recruiter' => "Je peux vous présenter les aspects techniques du profil : compétences Laravel/PHP, expérience en développement web, projets réalisés. Pouvez-vous préciser votre question sur son parcours ou ses compétences ?",
            
            'client' => "Je peux vous renseigner sur les services proposés : développement web, applications Laravel, sites modernes. Quel type de projet avez-vous en tête ?",
            
            'visitor' => "Je peux vous aider à découvrir le portfolio : compétences techniques, projets réalisés, technologies utilisées. Essayez de demander 'compétences', 'projets' ou 'expérience'."
        ];

        return $responses[$context['user_type']] ?? $responses['visitor'];
    }

    /**
     * Generate response for technical errors
     */
    private function generateTechnicalErrorResponse(array $context): string
    {
        return "Je rencontre une difficulté technique temporaire. Cependant, je reste à votre disposition pour présenter les informations essentielles du portfolio. Le développeur est spécialisé en Laravel, avec une expertise en développement web full-stack. Que souhaitez-vous savoir ?";
    }

    /**
     * Generate default fallback response
     */
    private function generateDefaultFallbackResponse(array $context): string
    {
        return "Je suis l'assistant IA du portfolio. Je peux vous présenter les compétences, projets et expériences du développeur Full Stack. N'hésitez pas à me poser des questions sur ses réalisations, technologies ou services.";
    }

    /**
     * Apply personality rules to response
     */
    private function applyPersonalityRules(string $response): string
    {
        // Ensure professional tone
        $response = str_replace(['lol', 'mdr'], '', $response);
        
        // Add helpful suggestions
        if (!Str::contains($response, ['?']) && !Str::contains($response, ['souhaitez', 'intéressé', 'préférez'])) {
            $response .= " Comment puis-je vous aider davantage ?";
        }

        // Ensure conversation continues
        if (!Str::contains($response, ['découvrir', 'présenter', 'savoir', 'renseigner'])) {
            $response = "Je peux vous présenter plus d'informations. " . $response;
        }

        return $response;
    }

    /**
     * Get contextual response based on keywords
     */
    public function getContextualResponse(string $question): ?string
    {
        $question = strtolower($question);

        // Direct keyword matches
        if (Str::contains($question, ['qui es-tu', 'who are you', 'présente-toi'])) {
            return "Je suis l'assistant IA du portfolio. Je peux vous présenter les compétences, projets et expériences du développeur Full Stack Software Engineer.";
        }

        if (Str::contains($question, ['compétences', 'skills', 'technologies'])) {
            return "Les compétences principales incluent : Laravel (expert), PHP, JavaScript, Vue.js, React, Bootstrap, TailwindCSS, Docker, AWS, MySQL, PostgreSQL.";
        }

        if (Str::contains($question, ['projets', 'projects', 'réalisations'])) {
            return "Le développeur réalise des projets web modernes : applications Laravel, sites responsive, systèmes backend, interfaces utilisateur modernes.";
        }

        if (Str::contains($question, ['contact', 'contacter', 'email'])) {
            return "Vous pouvez contacter le développeur via le formulaire de contact sur ce site. Il répond généralement sous 24h.";
        }

        return null;
    }

    /**
     * Initialize fallback responses database
     */
    private function initializeFallbackResponses(): void
    {
        $this->fallbackResponses = [
            'welcome' => "Bonjour ! Je suis l'assistant IA du portfolio. Je peux vous présenter les compétences, projets et expériences du développeur. Comment puis-je vous aider ?",
            'goodbye' => "N'hésitez pas à revenir si vous avez d'autres questions. Vous pouvez également contacter directement le développeur via le formulaire de contact.",
            'help' => "Je peux vous renseigner sur : compétences techniques, projets réalisés, expérience professionnelle, services proposés, et modalités de contact. Que souhaitez-vous savoir ?"
        ];
    }

    /**
     * Initialize personality rules
     */
    private function initializePersonalityRules(): void
    {
        $this->personalityRules = [
            'always_helpful' => true,
            'professional_tone' => true,
            'conversation_continuation' => true,
            'no_technical_errors' => true,
            'context_aware' => true,
            'multilingual_capable' => true
        ];
    }

    /**
     * Initialize contextual responses
     */
    private function initializeContextualResponses(): void
    {
        $this->contextualResponses = [
            'recruiter_focus' => [
                'Compétences techniques avancées',
                'Expérience pertinente',
                'Projets significatifs',
                'Technologies modernes'
            ],
            'client_focus' => [
                'Solutions web sur mesure',
                'Applications performantes',
                'Maintenance évolutive',
                'Support technique'
            ],
            'visitor_focus' => [
                'Portfolio complet',
                'Projets variés',
                'Technologies maîtrisées',
                'Parcours professionnel'
            ]
        ];
    }

    /**
     * Check if response is valid and useful
     */
    public function isValidResponse(string $response): bool
    {
        // Response must not be empty
        if (empty(trim($response))) {
            return false;
        }

        // Response must not contain error indicators
        $errorIndicators = ['error', 'erreur', 'undefined', 'null', 'technical difficulty', 'problème technique'];
        foreach ($errorIndicators as $indicator) {
            if (Str::contains(strtolower($response), $indicator)) {
                return false;
            }
        }

        // Response must be meaningful (at least 20 characters)
        if (strlen($response) < 20) {
            return false;
        }

        // Response must contain helpful content
        $helpfulWords = ['peux', 'peut', 'présenter', 'découvrir', 'compétences', 'projets', 'expériences', 'contact', 'aide'];
        $hasHelpfulContent = false;
        foreach ($helpfulWords as $word) {
            if (Str::contains(strtolower($response), $word)) {
                $hasHelpfulContent = true;
                break;
            }
        }

        return $hasHelpfulContent;
    }
}
