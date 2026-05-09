<?php

namespace Database\Seeders;

use App\Models\AiAgentMemory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AiAgentMemorySeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        DB::table('ai_agent_memory')->delete();

        // Profile Information
        AiAgentMemory::updateMemory('profile', 'identity', [
            'name' => 'Ingénieur Full Stack',
            'specialization' => 'Laravel, PHP, JavaScript, Cloud Architecture',
            'experience_years' => '5+',
            'location' => 'Brazzaville, République du Congo',
            'languages' => ['Français', 'Anglais'],
            'passion' => 'Innovation IA, Cloud, Développement moderne'
        ], 10);

        AiAgentMemory::updateMemory('profile', 'mission', [
            'title' => 'Mission',
            'description' => 'Transformer les besoins business en solutions web performantes et évolutives',
            'values' => ['Innovation', 'Qualité', 'Performance', 'Maintenabilité']
        ], 9);

        // Technical Skills
        AiAgentMemory::updateMemory('skills', 'backend', [
            'name' => 'Backend Development',
            'technologies' => [
                'Laravel' => ['level' => 'Expert', 'years' => '5+'],
                'PHP' => ['level' => 'Expert', 'years' => '6+'],
                'Node.js' => ['level' => 'Avancé', 'years' => '3'],
                'Python' => ['level' => 'Intermédiaire', 'years' => '2']
            ],
            'apis' => ['REST', 'GraphQL', 'WebSocket'],
            'databases' => ['MySQL', 'PostgreSQL', 'MongoDB', 'Redis']
        ], 10);

        AiAgentMemory::updateMemory('skills', 'frontend', [
            'name' => 'Frontend Development',
            'technologies' => [
                'JavaScript' => ['level' => 'Avancé', 'years' => '4+'],
                'Vue.js' => ['level' => 'Avancé', 'years' => '3'],
                'React' => ['level' => 'Intermédiaire', 'years' => '2'],
                'Bootstrap' => ['level' => 'Expert', 'years' => '5+'],
                'TailwindCSS' => ['level' => 'Avancé', 'years' => '2']
            ],
            'tools' => ['Vite', 'Webpack', 'Sass']
        ], 9);

        AiAgentMemory::updateMemory('skills', 'cloud_devops', [
            'name' => 'Cloud & DevOps',
            'technologies' => [
                'AWS' => ['level' => 'Intermédiaire', 'services' => ['EC2', 'S3', 'Lambda']],
                'Docker' => ['level' => 'Avancé', 'years' => '3'],
                'CI/CD' => ['tools' => ['GitHub Actions', 'GitLab CI']],
                'Deployment' => ['DigitalOcean', 'VPS', 'Docker Swarm']
            ]
        ], 8);

        // Services
        AiAgentMemory::updateMemory('services', 'development', [
            'name' => 'Développement Web',
            'description' => 'Applications web sur mesure avec architecture moderne et scalable',
            'deliverables' => ['Applications full stack', 'APIs REST', 'Applications SaaS'],
            'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Redis']
        ], 10);

        AiAgentMemory::updateMemory('services', 'consulting', [
            'name' => 'Consulting Technique',
            'description' => 'Audit d\'architecture, optimisation de performance, conseil technique',
            'deliverables' => ['Architecture review', 'Performance audit', 'Technical roadmap'],
            'expertise' => ['System design', 'Scalability', 'Performance optimization']
        ], 9);

        AiAgentMemory::updateMemory('services', 'maintenance', [
            'name' => 'Maintenance & Support',
            'description' => 'Maintenance continue, support technique, évolutions applicatives',
            'deliverables' => ['Bug fixes', 'Feature updates', 'Security patches', 'Performance monitoring'],
            'availability' => '24/7 monitoring, response time < 4h'
        ], 8);

        // Projects (sample data - will be synced with actual projects)
        AiAgentMemory::updateMemory('projects', 'featured', [
            'count' => '10+',
            'types' => ['E-commerce', 'SaaS', 'API platforms', 'Mobile backends', 'Corporate websites'],
            'highlights' => [
                'Platforme SaaS avec 10k+ utilisateurs',
                'API REST gérant 1M+ requêtes/jour',
                'E-commerce avec panier complexe et paiements',
                'Dashboard temps réel avec WebSocket'
            ],
            'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Redis', 'Docker']
        ], 10);

        // Experience
        AiAgentMemory::updateMemory('experience', 'current', [
            'role' => 'Full Stack Engineer',
            'focus' => 'Applications web modernes et architectures cloud',
            'achievements' => [
                'Architecture de systèmes scalables',
                'Optimisation performance x10',
                'Mentoring équipes junior',
                'Implementation DevOps practices'
            ]
        ], 10);

        // Contact & Availability
        AiAgentMemory::updateMemory('contact', 'availability', [
            'status' => 'Disponible pour nouveaux projets',
            'response_time' => 'Moins de 48h',
            'engagement' => 'Communication transparente et régulière',
            'timezone' => 'GMT+1 (Brazzaville)'
        ], 10);

        AiAgentMemory::updateMemory('contact', 'methods', [
            'preferred' => ['Formulaire de contact', 'WhatsApp'],
            'alternative' => ['Email', 'LinkedIn'],
            'response_priority' => ['Urgent (WhatsApp)', 'Standard (Email/Formulaire)']
        ], 9);

        // AI Agent Configuration
        AiAgentMemory::updateMemory('ai_config', 'personality', [
            'tone' => 'Professionnel, moderne, accessible',
            'communication_style' => 'Clair, concis, structuré',
            'values' => ['Excellence technique', 'Innovation', 'Fiabilité'],
            'specialties' => ['Laravel', 'Architecture scalable', 'Performance']
        ], 10);

        AiAgentMemory::updateMemory('ai_config', 'responses', [
            'greeting' => 'Bonjour ! Je suis l\'assistant IA de cet ingénieur full stack. Comment puis-je vous aider aujourd\'hui ?',
            'help_topics' => ['compétences techniques', 'projets réalisés', 'services proposés', 'contact et disponibilité'],
            'no_answer' => 'C\'est une excellente question ! Pour une réponse détaillée adaptée à vos besoins, je vous invite à contacter directement via le formulaire ou WhatsApp.'
        ], 9);
    }
}
