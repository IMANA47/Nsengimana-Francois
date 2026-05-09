<?php

namespace App\Services;

use App\Services\AiResponseManager;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AiAgentService
{
    private array $memory = [];
    private array $conversationHistory = [];
    private array $suggestions = [];
    private AiResponseManager $responseManager;

    public function __construct()
    {
        $this->responseManager = new AiResponseManager();
        $this->loadMemory();
        $this->initializeSuggestions();
    }

    /**
     * Load AI agent memory from database
     */
    private function loadMemory(): void
    {
        $this->memory = Cache::remember('ai_agent_memory', 3600, function () {
            return [
                'profile' => AiAgentMemory::getProfile(),
                'skills' => AiAgentMemory::getSkills(),
                'projects' => AiAgentMemory::getProjects(),
                'experience' => AiAgentMemory::getExperience(),
                'services' => AiAgentMemory::getServices(),
                'certifications' => AiAgentMemory::getCertifications(),
                'contact' => AiAgentMemory::where('category', 'contact')->active()->pluck('data', 'key')->toArray(),
                'ai_config' => AiAgentMemory::where('category', 'ai_config')->active()->pluck('data', 'key')->toArray()
            ];
        });
    }

    /**
     * Process user question and generate response
     */
    public function processQuestion(string $question): array
    {
        try {
            // Add to conversation history
            $this->addToHistory($question, 'user');

            // First try contextual response
            $contextualResponse = $this->responseManager->getContextualResponse($question);
            if ($contextualResponse && $this->responseManager->isValidResponse($contextualResponse)) {
                $response = $contextualResponse;
            } else {
                // Generate response based on intent
                $response = $this->generateResponse($question);
                
                // Validate response, use fallback if invalid
                if (!$this->responseManager->isValidResponse($response)) {
                    $response = $this->responseManager->generateFallbackResponse($question, 'empty_response');
                }
            }

            // Add to conversation history
            $this->addToHistory($response, 'assistant');

            // Calculate confidence
            $confidence = $this->calculateConfidence($question, $response);

            // Generate suggestions
            $suggestions = $this->generateSuggestions($question);

            return [
                'response' => $response,
                'confidence' => $confidence,
                'suggestions' => $suggestions,
                'category' => $this->categorizeQuestion($question)
            ];

        } catch (\Exception $e) {
            Log::error('AI Agent processing error: ' . $e->getMessage());
            
            // Use intelligent fallback instead of generic error
            $fallbackResponse = $this->responseManager->generateFallbackResponse($question, 'technical_error');
            
            return [
                'response' => $fallbackResponse,
                'confidence' => 0.3, // Low confidence but not zero
                'suggestions' => $this->getRecoverySuggestions(),
                'category' => 'fallback'
            ];
        }
    }

    /**
     * Generate intelligent response based on question analysis
     */
    private function generateResponse(string $question): string
    {
        // Check for greetings
        if ($this->isGreeting($question)) {
            return $this->memory['ai_config']['responses']['greeting'] ?? 'Bonjour ! Je suis l\'assistant IA du portfolio. Je peux vous présenter les compétences, projets et expériences du développeur. Comment puis-je vous aider ?';
        }

        // Check for skills/competencies questions
        if ($this->isAboutSkills($question)) {
            return $this->generateSkillsResponse($question);
        }

        // Check for projects questions
        if ($this->isAboutProjects($question)) {
            return $this->generateProjectsResponse($question);
        }

        // Check for experience questions
        if ($this->isAboutExperience($question)) {
            return $this->generateExperienceResponse($question);
        }

        // Check for services questions
        if ($this->isAboutServices($question)) {
            return $this->generateServicesResponse($question);
        }

        // Check for pricing/cost questions
        if ($this->isAboutPricing($question)) {
            return $this->generatePricingResponse($question);
        }

        // Check for timeline/availability questions
        if ($this->isAboutTimeline($question)) {
            return $this->generateTimelineResponse($question);
        }

        // Use fallback for unknown questions
        return $this->responseManager->generateFallbackResponse($question, 'not_understood');
    }

    /**
     * Generate skills-related response
     */
    private function generateSkillsResponse(string $question): string
    {
        $skills = $this->memory['skills'];
        
        if (Str::contains($question, ['laravel', 'php'])) {
            $backend = $skills['backend'] ?? [];
            $laravel = $backend['technologies']['Laravel'] ?? [];
            return "Je suis **expert en Laravel** avec {$laravel['years']}+ années d'expérience. J'ai développé des applications complexes, des APIs performantes et des architectures scalables. Mon expertise couvre tout l'écosystème Laravel : Eloquent, Blade, Queues, Broadcasting, et les meilleures pratiques de sécurité.\n\n**I'm a Laravel expert** with {$laravel['years']}+ years of experience. I've developed complex applications, high-performance APIs, and scalable architectures. My expertise covers the entire Laravel ecosystem: Eloquent, Blade, Queues, Broadcasting, and security best practices.";
        }

        if (Str::contains($question, ['javascript', 'js', 'vue', 'react'])) {
            $frontend = $skills['frontend'] ?? [];
            $js = $frontend['technologies']['JavaScript'] ?? [];
            return "En frontend, je maîtrise **JavaScript** ({$js['years']}+ ans) avec **Vue.js** et **React**. Je crée des interfaces modernes, réactives et optimisées, en suivant les meilleures pratiques de UX et de performance.\n\n**In frontend**, I master **JavaScript** ({$js['years']}+ years) with **Vue.js** and **React**. I create modern, reactive, and optimized interfaces, following UX and performance best practices.";
        }

        if (Str::contains($question, ['cloud', 'aws', 'docker', 'devops'])) {
            $cloud = $skills['cloud_devops'] ?? [];
            return "J'ai des compétences solides en **Cloud & DevOps** : **Docker** pour la containerisation, **AWS** (EC2, S3, Lambda) pour le cloud, et **CI/CD** avec GitHub Actions. Je déploie des applications robustes et scalables.\n\n**I have strong Cloud & DevOps skills**: **Docker** for containerization, **AWS** (EC2, S3, Lambda) for cloud, and **CI/CD** with GitHub Actions. I deploy robust and scalable applications.";
        }

        // General skills response
        $backend = $skills['backend']['technologies'] ?? [];
        $frontend = $skills['frontend']['technologies'] ?? [];
        
        return "Mes compétences principales couvrent **l'ensemble du stack** :\n\n**Backend** : Laravel (expert), PHP, Node.js, Python\n**Frontend** : JavaScript, Vue.js, React, Bootstrap, TailwindCSS\n**Cloud** : Docker, AWS, CI/CD\n**Bases de données** : MySQL, PostgreSQL, Redis, MongoDB\n\nJ'excelle particulièrement dans **Laravel** et l'**architecture d'applications web évolutives**.\n\n**My main skills cover the entire stack**:\n\n**Backend**: Laravel (expert), PHP, Node.js, Python\n**Frontend**: JavaScript, Vue.js, React, Bootstrap, TailwindCSS\n**Cloud**: Docker, AWS, CI/CD\n**Databases**: MySQL, PostgreSQL, Redis, MongoDB\n\nI particularly excel in **Laravel** and **scalable web application architectures**.";
    }

    /**
     * Generate projects-related response
     */
    private function generateProjectsResponse(string $question): string
    {
        $projects = $this->memory['projects']['featured'] ?? [];
        $count = $projects['count'] ?? '10+';
        $types = implode(', ', $projects['types'] ?? []);
        $highlights = $projects['highlights'] ?? [];

        $response = "J'ai réalisé **{$count} projets** variés couvrant : {$types}.\n\n**Quelques réalisations marquantes** :\n";
        
        foreach (array_slice($highlights, 0, 3) as $highlight) {
            $response .= "• {$highlight}\n";
        }

        $response .= "\nChaque projet est optimisé pour la **performance**, la **sécurité** et la **maintenabilité**. J'utilise les meilleures pratiques d'architecture et les technologies modernes.";

        return $response;
    }

    /**
     * Generate services-related response
     */
    private function generateServicesResponse(string $question): string
    {
        $services = $this->memory['services'];
        
        if (Str::contains($question, ['développement', 'application', 'web'])) {
            $dev = $services['development'] ?? [];
            return "En **développement web**, je crée des applications sur mesure avec :\n\n**Livraison** : " . implode(', ', $dev['deliverables'] ?? []) . "\n**Technologies** : " . implode(', ', $dev['technologies'] ?? []) . "\n**Approche** : Architecture scalable, code propre, tests automatisés";
        }

        if (Str::contains($question, ['consulting', 'conseil', 'audit', 'optimisation'])) {
            $consulting = $services['consulting'] ?? [];
            return "En **consulting technique**, j'offre :\n\n**Services** : " . implode(', ', $consulting['deliverables'] ?? []) . "\n**Expertise** : " . implode(', ', $consulting['expertise'] ?? []) . "\n**Objectif** : Optimiser vos applications existantes et définir la meilleure architecture pour vos besoins.";
        }

        $response = "Je propose plusieurs services :\n\n";
        foreach ($services as $key => $service) {
            if (isset($service['name'])) {
                $response .= "**{$service['name']}** : {$service['description']}\n";
            }
        }
        
        return $response;
    }

    /**
     * Generate experience-related response
     */
    private function generateExperienceResponse(string $question): string
    {
        $experience = $this->memory['experience']['current'] ?? [];
        $profile = $this->memory['profile']['identity'] ?? [];
        
        $response = "J'ai **{$profile['experience_years']}+ d'expérience** en tant que **{$experience['role']}**.\n\n";
        $response .= "**Focus actuel** : {$experience['focus']}\n\n";
        $response .= "**Réalisations principales** :\n";
        
        foreach ($experience['achievements'] ?? [] as $achievement) {
            $response .= "• {$achievement}\n";
        }

        return $response;
    }

    /**
     * Generate contact-related response
     */
    private function generateContactResponse(string $question): string
    {
        $contact = $this->memory['contact'];
        $availability = $contact['availability'] ?? [];
        $methods = $contact['methods'] ?? [];

        $response = "**Disponibilité** : {$availability['status']}\n";
        $response .= "**Temps de réponse** : {$availability['response_time']}\n\n";
        $response .= "**Méthodes de contact préférées** : " . implode(', ', $methods['preferred'] ?? []) . "\n\n";
        $response .= "Je m'engage à une **communication transparente** et des **réponses rapides** pour garantir le succès de votre projet.";

        return $response;
    }

    /**
     * Generate technology-specific response
     */
    private function generateTechnologyResponse(string $question): string
    {
        $skills = $this->memory['skills'];
        
        foreach (['laravel', 'php', 'javascript', 'vue', 'react', 'mysql', 'docker', 'aws'] as $tech) {
            if (Str::contains($question, $tech)) {
                // Find technology details
                foreach ($skills as $category => $data) {
                    if (isset($data['technologies'][$tech])) {
                        $info = $data['technologies'][$tech];
                        $level = $info['level'] ?? 'Avancé';
                        $years = $info['years'] ?? 'Multiple';
                        return "En **{$tech}**, j'ai un niveau **{$level}** avec {$years} années d'expérience. Je l'utilise régulièrement dans des projets professionnels pour créer des solutions robustes et performantes.";
                    }
                }
            }
        }

        return "J'ai une large expertise technologique. Posez-moi une question spécifique sur Laravel, PHP, JavaScript, Vue.js, Docker, AWS ou toute autre technologie qui vous intéresse.";
    }

    /**
     * Generate pricing-related response
     */
    private function generatePricingResponse(string $question): string
    {
        return "Pour connaître mes tarifs, je vous invite à me contacter directement. Les prix sont adaptés selon :\n\n• Complexité du projet\n• Durée estimée\n• Technologies requises\n• Niveau d'expertise nécessaire\n\nContactez-moi pour un devis personnalisé basé sur vos besoins spécifiques.";
    }

    /**
     * Generate timeline-related response
     */
    private function generateTimelineResponse(string $question): string
    {
        if (Str::contains($question, ['urgent', 'vite', 'rapide'])) {
            return "Je peux m'adapter aux projets urgents. Contactez-moi directement pour discuter de votre timeline et de vos besoins spécifiques. Je propose des solutions rapides sans compromettre la qualité.";
        }

        return "Je suis actuellement disponible pour de nouveaux projets. Les délais varient selon la complexité :\n\n• Projets simples : 2-4 semaines\n• Applications moyennes : 1-3 mois\n• Projets complexes : 3-6 mois\n\nContactez-moi pour une estimation précise de votre projet.";
    }

    /**
     * Generate default intelligent response
     */
    private function generateDefaultResponse(string $question): string
    {
        return "C'est une excellente question ! Pour une réponse détaillée adaptée à vos besoins spécifiques, je vous invite à me contacter directement via le formulaire de contact ou WhatsApp. Je serai ravi de discuter de votre projet en détail.";
    }

    /**
     * Question analysis methods
     */
    private function isGreeting(string $question): bool
    {
        return in_array($question, ['hello', 'bonjour', 'salut', 'hi', 'hey']) ||
               Str::contains($question, ['hello', 'bonjour', 'salut', 'hi', 'hey']);
    }

    private function isAboutSkills(string $question): bool
    {
        return Str::contains($question, [
            'compétence', 'skill', 'technologie', 'tech', 'sait', 'maîtrise', 'expertise'
        ]);
    }

    private function isAboutProjects(string $question): bool
    {
        return Str::contains($question, [
            'projet', 'réalisation', 'portfolio', 'travail', 'créé', 'développé'
        ]);
    }

    private function isAboutServices(string $question): bool
    {
        return Str::contains($question, [
            'service', 'aide', 'propose', 'offre', 'fait', 'peut faire'
        ]);
    }

    private function isAboutExperience(string $question): bool
    {
        return Str::contains($question, [
            'expérience', 'parcours', 'histoire', 'depuis', 'années'
        ]);
    }

    private function isAboutContact(string $question): bool
    {
        return Str::contains($question, [
            'contact', 'contacter', 'joindre', 'disponible', 'répond'
        ]);
    }

    private function isAboutTechnology(string $question): bool
    {
        return Str::contains($question, [
            'laravel', 'php', 'javascript', 'vue', 'react', 'mysql', 'docker', 'aws'
        ]);
    }

    private function isAboutPricing(string $question): bool
    {
        return Str::contains($question, [
            'prix', 'coût', 'tarif', 'payer', 'budget', 'cher'
        ]);
    }

    private function isAboutTimeline(string $question): bool
    {
        return Str::contains($question, [
            'temps', 'délai', 'urgent', 'vite', 'disponibilité', 'quand'
        ]);
    }

    /**
     * Generate smart suggestions based on conversation context
     */
    private function generateSuggestions(string $question): array
    {
        $suggestions = [];

        if ($this->isAboutSkills($question)) {
            $suggestions = ['Niveau en Laravel ?', 'Technologies frontend ?', 'Expérience Cloud ?'];
        } elseif ($this->isAboutProjects($question)) {
            $suggestions = ['Projets récents ?', 'Technologies utilisées ?', 'Défis techniques ?'];
        } elseif ($this->isAboutServices($question)) {
            $suggestions = ['Tarifs des services ?', 'Délais de livraison ?', 'Méthodologie de travail ?'];
        } else {
            $suggestions = ['Compétences techniques', 'Services proposés', 'Projets réalisés', 'Contact et disponibilité'];
        }

        return $suggestions;
    }

    /**
     * Generate recovery suggestions for fallback scenarios
     */
    private function getRecoverySuggestions(): array
    {
        return [
            "Découvrir les compétences techniques",
            "Voir les projets réalisés",
            "Connaître l'expérience professionnelle",
            "Modalités de contact",
            "Services proposés"
        ];
    }

    /**
     * Calculate response confidence
     */
    private function calculateConfidence(string $question): float
    {
        if ($this->isGreeting($question)) return 1.0;
        if ($this->isAboutTechnology($question)) return 0.9;
        if ($this->isAboutSkills($question)) return 0.85;
        if ($this->isAboutProjects($question)) return 0.8;
        if ($this->isAboutServices($question)) return 0.8;
        
        return 0.6;
    }

    /**
     * Categorize question type
     */
    private function categorizeQuestion(string $question): string
    {
        if ($this->isGreeting($question)) return 'greeting';
        if ($this->isAboutSkills($question)) return 'skills';
        if ($this->isAboutProjects($question)) return 'projects';
        if ($this->isAboutServices($question)) return 'services';
        if ($this->isAboutExperience($question)) return 'experience';
        if ($this->isAboutContact($question)) return 'contact';
        if ($this->isAboutTechnology($question)) return 'technology';
        if ($this->isAboutPricing($question)) return 'pricing';
        if ($this->isAboutTimeline($question)) return 'timeline';
        
        return 'general';
    }

    /**
     * Get conversation history
     */
    public function getConversationHistory(): array
    {
        return $this->conversation;
    }

    /**
     * Clear conversation history
     */
    public function clearConversation(): void
    {
        $this->conversation = [];
    }

    /**
     * Refresh memory cache
     */
    public function refreshMemory(): void
    {
        Cache::forget('ai_agent_memory');
        $this->loadMemory();
    }
}
