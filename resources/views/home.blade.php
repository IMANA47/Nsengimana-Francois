<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portfolio moderne Laravel orienté business pour clients et recruteurs.">
    <meta property="og:title" content="Portfolio Full Stack Software Engineer">
    <meta property="og:description" content="Portfolio moderne Laravel orienté business pour clients et recruteurs.">
    <meta property="og:type" content="website">
    <link rel="shortcut icon" href="{{ asset('asset/logoimana.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('asset/logoimana.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('asset/logoimana.png') }}">
    <title>Imana47</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand text-brand fw-bold" href="#home">
                <img src="{{ asset('asset/logoimana.png') }}" alt="Imana47 Logo" class="me-2" style="height: 40px; width: auto;">
                Imana47
            </a>
            <button class="navbar-toggler border-brand" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
                    <li class="nav-item"><a class="nav-link" href="#certificates">Certificates</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="section-block">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-7 col-xl-8 reveal">
                    <div class="hero-content">
                        <h1 class="display-3 display-md-2 display-xl-1 fw-bold mb-4">Full Stack Developer</h1>
                        <p class="text-brand h3 h4-md h3-xl mb-4">Laravel & Modern Web Specialist</p>
                        <p class="lead text-white-50 mb-5 mb-lg-4">I design performant, scalable and business-oriented web applications.</p>
                        <div class="d-flex flex-column flex-sm-row gap-3 gap-md-4">
                            <a class="btn btn-brand btn-lg flex-fill flex-sm-auto" href="#contact">
                                <i class="bi bi-envelope me-2"></i>Contact Me
                            </a>
                            <a class="btn btn-outline-light btn-lg flex-fill flex-sm-auto" href="#projects">
                                <i class="bi bi-folder me-2"></i>View Projects
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4 reveal">
                    <div class="hero-image-wrapper text-center">
                        <div class="hero-profile-circle bg-brand rounded-circle d-inline-flex align-items-center justify-content-center mx-auto">
                            <img src="{{ asset('asset/ImageMe.jpg') }}" alt="Profile Image" class="hero-profile-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('sections.about')
    @include('sections.projects')
    @include('sections.skills')
    @include('sections.experience')
    @include('sections.services')
    @include('sections.testimonials')
    @include('sections.certificates')
    @include('sections.contact')

    <!-- AI Chat Component -->
    @include('components.ai-chat', ['isOpen' => false])

    <!-- WhatsApp Floating Button -->
    <a class="btn btn-success floating-whatsapp" target="_blank" href="https://wa.me/243900000000?text=Bonjour%2C%20je%20suis%20interesse%20par%20vos%20services" aria-label="WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <style>
        /* WhatsApp Button Positioning */
        .floating-whatsapp {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9997;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
        }

        .floating-whatsapp:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.5);
        }

        .floating-whatsapp i {
            font-size: 24px;
        }

        /* Adjust AI Chat container for mobile */
        @media (max-width: 768px) {
            .ai-chat-container {
                bottom: 10px;
                right: 10px;
                left: 10px;
                width: calc(100vw - 20px);
                height: calc(100vh - 100px);
            }

            .floating-whatsapp {
                bottom: 80px;
                left: 10px;
                width: 48px;
                height: 48px;
            }

            .floating-whatsapp i {
                font-size: 20px;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    class AIChatManager {
        constructor() {
            this.isOpen = false;
            this.isTyping = false;
            this.conversationHistory = [];
            
            this.initElements();
            this.initEventListeners();
            this.loadConversationHistory();
        }

        initElements() {
            this.container = document.getElementById('aiChatContainer');
            this.floatingBtn = document.getElementById('aiFloatingBtn');
            this.messagesContainer = document.getElementById('aiChatMessages');
            this.inputField = document.getElementById('aiChatInput');
            this.sendBtn = document.getElementById('aiSendBtn');
            this.clearBtn = document.getElementById('aiClearBtn');
            this.minimizeBtn = document.getElementById('aiMinimizeBtn');
        }

        initEventListeners() {
            // Toggle chat
            this.floatingBtn?.addEventListener('click', () => this.openChat());
            this.minimizeBtn?.addEventListener('click', () => this.closeChat());
            
            // Send message
            this.sendBtn?.addEventListener('click', () => this.sendMessage());
            this.inputField?.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    this.sendMessage();
                }
            });
            
            // Clear conversation
            this.clearBtn?.addEventListener('click', () => this.clearConversation());
            
            // Input field
            this.inputField?.addEventListener('input', () => this.handleInputChange());
            
            // Suggestion chips
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('ai-suggestion-chip')) {
                    const suggestion = e.target.getAttribute('data-suggestion');
                    this.inputField.value = suggestion;
                    this.sendMessage();
                }
            });
        }

        openChat() {
            this.isOpen = true;
            this.container.style.display = 'flex';
            this.floatingBtn.style.display = 'none';
            this.inputField?.focus();
        }

        closeChat() {
            this.isOpen = false;
            this.container.style.display = 'none';
            this.floatingBtn.style.display = 'flex';
        }

        async sendMessage() {
            const message = this.inputField?.value?.trim();
            if (!message || this.isTyping) return;

            // Add user message
            this.addMessage(message, 'user');
            this.inputField.value = '';
            this.handleInputChange();

            // Show typing indicator
            this.showTypingIndicator();

            try {
                const response = await fetch('/api/ai/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    },
                    body: JSON.stringify({
                        message: message,
                        context: {
                            conversation: this.conversationHistory.slice(-5) // Last 5 messages for context
                        }
                    })
                });

                if (!response.ok) throw new Error('Network error');

                const data = await response.json();
                this.hideTypingIndicator();
                
                // Add AI response with typing animation
                await this.addMessageWithTyping(data.message, 'ai');
                
                // Update suggestions if available
                if (data.suggestions && data.suggestions.length > 0) {
                    this.updateSuggestions(data.suggestions);
                }

            } catch (error) {
                console.error('AI Chat Error:', error);
                this.hideTypingIndicator();
                this.addMessage('Désolé, je rencontre des difficultés techniques. Veuillez réessayer plus tard.', 'ai');
            }
        }

        addMessage(text, type) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `ai-${type}-message`;
            
            if (type === 'user') {
                messageDiv.innerHTML = `
                    <div class="ai-message-content">
                        <div class="ai-message-text">${this.escapeHtml(text)}</div>
                    </div>
                `;
            } else {
                messageDiv.innerHTML = `
                    <div class="ai-avatar-small">
                        <i class="bi bi-robot"></i>
                    </div>
                    <div class="ai-message-content">
                        <div class="ai-message-text">${this.formatMessage(text)}</div>
                    </div>
                `;
            }

            this.messagesContainer.appendChild(messageDiv);
            this.scrollToBottom();
            
            // Update conversation history
            this.conversationHistory.push({
                type: type,
                message: text,
                timestamp: new Date().toISOString()
            });
            
            this.saveConversationHistory();
        }

        async addMessageWithTyping(text, type) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `ai-${type}-message`;
            
            const avatarDiv = document.createElement('div');
            avatarDiv.className = 'ai-avatar-small';
            avatarDiv.innerHTML = '<i class="bi bi-robot"></i>';
            
            const contentDiv = document.createElement('div');
            contentDiv.className = 'ai-message-content';
            
            const textDiv = document.createElement('div');
            textDiv.className = 'ai-message-text';
            
            messageDiv.appendChild(avatarDiv);
            contentDiv.appendChild(textDiv);
            messageDiv.appendChild(contentDiv);
            
            this.messagesContainer.appendChild(messageDiv);
            this.scrollToBottom();
            
            // Typing animation
            await this.typingAnimation(textDiv, text);
            
            // Update conversation history
            this.conversationHistory.push({
                type: type,
                message: text,
                timestamp: new Date().toISOString()
            });
            
            this.saveConversationHistory();
        }

        async typingAnimation(element, text) {
            const chars = text.split('');
            let currentText = '';
            
            for (let i = 0; i < chars.length; i++) {
                currentText += chars[i];
                element.innerHTML = this.formatMessage(currentText) + '<span class="ai-cursor">|</span>';
                this.scrollToBottom();
                await this.delay(20 + Math.random() * 10); // Variable typing speed
            }
            
            element.innerHTML = this.formatMessage(text);
        }

        formatMessage(text) {
            // Convert markdown-like formatting to HTML
            return text
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/`(.*?)`/g, '<code>$1</code>')
                .replace(/\n/g, '<br>');
        }

        showTypingIndicator() {
            this.isTyping = true;
            const typingDiv = document.createElement('div');
            typingDiv.className = 'ai-ai-message ai-typing-message';
            typingDiv.innerHTML = `
                <div class="ai-avatar-small">
                    <i class="bi bi-robot"></i>
                </div>
                <div class="ai-message-content">
                    <div class="ai-typing-indicator">
                        <div class="ai-typing-dot"></div>
                        <div class="ai-typing-dot"></div>
                        <div class="ai-typing-dot"></div>
                    </div>
                </div>
            `;
            typingDiv.id = 'aiTypingIndicator';
            this.messagesContainer.appendChild(typingDiv);
            this.scrollToBottom();
        }

        hideTypingIndicator() {
            this.isTyping = false;
            const typingIndicator = document.getElementById('aiTypingIndicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }

        updateSuggestions(suggestions) {
            // This would update suggestion chips
            // Implementation depends on UI requirements
        }

        clearConversation() {
            if (confirm('Êtes-vous sûr de vouloir effacer toute la conversation ?')) {
                // Clear messages except welcome message
                const messages = this.messagesContainer.querySelectorAll('.ai-user-message, .ai-ai-message');
                messages.forEach(msg => msg.remove());
                
                // Clear history
                this.conversationHistory = [];
                this.saveConversationHistory();
                
                // Show confirmation
                this.addMessage('Conversation effacée. Comment puis-je vous aider ?', 'ai');
            }
        }

        handleInputChange() {
            const hasText = this.inputField?.value?.trim().length > 0;
            if (this.sendBtn) {
                this.sendBtn.disabled = !hasText;
            }
            
            // Auto-resize textarea
            if (this.inputField) {
                this.inputField.style.height = 'auto';
                this.inputField.style.height = Math.min(this.inputField.scrollHeight, 100) + 'px';
            }
        }

        scrollToBottom() {
            this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
        }

        escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        delay(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        saveConversationHistory() {
            try {
                localStorage.setItem('aiChatHistory', JSON.stringify(this.conversationHistory));
            } catch (e) {
                console.warn('Could not save conversation history:', e);
            }
        }

        loadConversationHistory() {
            try {
                const saved = localStorage.getItem('aiChatHistory');
                if (saved) {
                    this.conversationHistory = JSON.parse(saved);
                }
            } catch (e) {
                console.warn('Could not load conversation history:', e);
            }
        }
    }

    // Initialize AI Chat when DOM is ready
    document.addEventListener('DOMContentLoaded', () => {
        window.aiChat = new AIChatManager();
    });

    // Reveal animations for sections
    const reveals = document.querySelectorAll(".reveal");
    const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => e.target.classList.toggle("show", e.isIntersecting));
    }, { threshold: 0.1 });
    reveals.forEach((el) => io.observe(el));

    // Add cursor animation style
    const style = document.createElement('style');
    style.textContent = `
        .ai-cursor {
            animation: aiCursor 1s infinite;
            color: #FFD700;
            font-weight: bold;
        }
        
        @keyframes aiCursor {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }
        
        .ai-message-text code {
            background: rgba(255, 215, 0, 0.1);
            border: 1px solid rgba(255, 215, 0, 0.3);
            border-radius: 4px;
            padding: 2px 6px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
        }
    `;
    document.head.appendChild(style);
    </script>
</body>
</html>
        <i class="bi bi-chat-dots"></i>
    </button>
    <a class="btn btn-success floating-whatsapp" target="_blank" href="https://wa.me/{{ $profile['whatsapp'] }}?text=Bonjour%2C%20je%20suis%20interesse%20par%20vos%20services" aria-label="WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="chatbotPanel" aria-labelledby="chatbotLabel" style="width: 400px;">
        <div class="offcanvas-header bg-brand text-dark">
            <h5 class="offcanvas-title" id="chatbotLabel">
                <i class="bi bi-robot me-2"></i>Assistant IA
            </h5>
            <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="chatMessages" class="mb-3" style="max-height: 400px; overflow-y: auto;">
                <div class="text-center mb-3">
                    <i class="bi bi-robot text-brand fs-1 mb-2"></i>
                    <p class="text-white small">Bonjour ! Je suis votre assistant personnel. Posez-moi des questions sur mes compétences, services ou projets !</p>
                </div>
            </div>
            <div class="input-group">
                <input id="chatInput" class="form-control" placeholder="Écrivez votre message..." aria-label="Chat input">
                <button id="chatSend" class="btn btn-brand">
                    <i class="bi bi-send"></i>
                </button>
            </div>
            <div class="mt-2">
                <small class="text-muted">Suggestions:</small>
                <div class="d-flex flex-wrap gap-1 mt-1">
                    <button class="btn btn-sm btn-outline-light suggestion-btn" data-suggestion="compétences">Compétences</button>
                    <button class="btn btn-sm btn-outline-light suggestion-btn" data-suggestion="services">Services</button>
                    <button class="btn btn-sm btn-outline-light suggestion-btn" data-suggestion="contact">Contact</button>
                    <button class="btn btn-sm btn-outline-light suggestion-btn" data-suggestion="projets">Projets</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const answers = {
            // Questions sur l'identité
            "qui es-tu ?": "Je suis un ingénieur full stack spécialisé dans le développement d'applications web modernes avec Laravel et PHP. Je transforme les besoins business en solutions performantes et évolutives.",
            "qui es tu": "Je suis un ingénieur full stack spécialisé dans le développement d'applications web modernes avec Laravel et PHP.",
            "présente-toi": "Je suis un ingénieur full stack passionné par la création de solutions web performantes. J'excelle dans Laravel, PHP, JavaScript et l'architecture logicielle.",
            
            // Compétences techniques
            "compétences": "Mes compétences principales incluent: Laravel (expert), PHP, JavaScript, Vue.js, MySQL, API REST, architecture logicielle, Bootstrap, et gestion de projet. Je maîtrise également Git, Docker et les méthodologies Agiles.",
            "technologies": "Je travaille principalement avec Laravel, PHP, JavaScript, Vue.js, MySQL, Redis, et j'ai une solide expérience avec les APIs REST, GraphQL et les microservices.",
            "stack technique": "Mon stack principal: Laravel + Vue.js + MySQL + Redis. Je suis également à l'aise avec Node.js, Python, et les plateformes cloud comme AWS et DigitalOcean.",
            
            // Services
            "services": "Je propose: Développement web sur mesure, Création d'API REST, Maintenance et optimisation d'applications, Architecture logicielle, Conseil technique, et Formation d'équipes de développement.",
            "que fais-tu": "Je développe des applications web professionnelles, crée des APIs robustes, optimise les performances, et accompagne les entreprises dans leur transformation numérique.",
            "aide": "Je peux vous aider avec: Développement de nouvelles fonctionnalités, Migration de systèmes existants, Optimisation des performances, Audit de code, et Conseil architectural.",
            
            // Contact
            "contact": "Pour me contacter: Utilisez le formulaire de contact sur ce site, ou envoyez un message WhatsApp. Je réponds généralement sous 48 heures. Email: contact@example.com",
            "comment te contacter": "Le plus simple est d'utiliser le formulaire de contact ou WhatsApp. Je suis également joignable par email pour les discussions plus détaillées.",
            
            // Projets
            "projets": "J'ai développé divers projets: Applications e-commerce, Plateformes SaaS, APIs pour mobiles, Systèmes de gestion, et Portfolios professionnels. Chaque projet est optimisé pour performance et maintenabilité.",
            "réalisations": "Mes réalisations incluent des applications Laravel complexes avec authentification, systèmes de paiement, tableaux de bord en temps réel, et intégrations avec des services tiers.",
            "portfolio": "Ce portfolio est une de mes réalisations - développé avec Laravel 13, Bootstrap 5, et une architecture modulaire pour faciliter l'ajout de nouvelles sections.",
            
            // Expérience
            "expérience": "J'ai plusieurs années d'expérience en développement full stack, avec une expertise particulière dans Laravel et l'architecture d'applications web évolutives et sécurisées.",
            "parcours": "Mon parcours combine formation technique et pratique professionnelle, me permettant de livrer des solutions à la fois innovantes et fiables.",
            
            // Disponibilité
            "disponible": "Je suis disponible pour de nouveaux projets. Contactez-moi pour discuter de vos besoins et établir un planning adapté à votre projet.",
            "tarifs": "Mes tarifs sont adaptés selon la complexité et la durée du projet. Contactez-moi pour un devis personnalisé basé sur vos besoins spécifiques.",
            
            // Salutations
            "hello": "Bonjour ! Je suis votre assistant IA. Comment puis-je vous aider aujourd'hui ?",
            "bonjour": "Bonjour ! Ravi de vous rencontrer. Posez-moi vos questions sur mes compétences, services ou projets !",
            "salut": "Salut ! Je suis là pour répondre à vos questions. N'hésitez pas à me demander ce que vous voulez savoir !",
            
            // Questions diverses
            "langages": "Je code principalement en PHP (Laravel), JavaScript (Vue.js, React), et j'ai des bases solides en Python, Go, et TypeScript.",
            "databases": "Ma principale expertise est MySQL, mais je travaille aussi avec PostgreSQL, MongoDB, Redis, et Elasticsearch selon les besoins du projet.",
            "déploiement": "J'ai de l'expérience avec Docker, CI/CD, et le déploiement sur AWS, DigitalOcean, et VPS classiques."
        };
        
        const list = document.getElementById("chatMessages");
        const input = document.getElementById("chatInput");
        const send = document.getElementById("chatSend");
        
        const add = (t, c = "text-brand", isTyping = false) => {
            const messageDiv = document.createElement("div");
            messageDiv.className = "mb-3";
            
            const p = document.createElement("p");
            p.className = c + " mb-0";
            
            if (isTyping) {
                p.innerHTML = t + '<span class="typing-cursor">|</span>';
                messageDiv.appendChild(p);
                list.appendChild(messageDiv);
                list.scrollTop = list.scrollHeight;
                return p;
            } else {
                p.textContent = t;
                messageDiv.appendChild(p);
                list.appendChild(messageDiv);
                list.scrollTop = list.scrollHeight;
            }
        };
        
        const typingAnimation = (text, callback) => {
            let index = 0;
            const typingElement = add("", "text-brand", true);
            
            const typeChar = () => {
                if (index < text.length) {
                    typingElement.innerHTML = text.substring(0, index + 1) + '<span class="typing-cursor">|</span>';
                    index++;
                    setTimeout(typeChar, 30);
                } else {
                    typingElement.innerHTML = text;
                    if (callback) callback();
                }
            };
            
            typeChar();
        };
        
        function sendMessage() {
            const q = (input.value || "").trim().toLowerCase();
            if (!q) return;
            
            // Message utilisateur
            add("Vous: " + input.value, "text-white");
            
            const response = answers[q] || generateSmartResponse(q);
            
            // Réponse avec animation
            setTimeout(() => {
                add("Assistant IA:", "text-brand");
                typingAnimation(response, () => {
                    // Animation terminée
                });
            }, 500);
            
            input.value = "";
        }
        
        function generateSmartResponse(question) {
            if (question.includes("prix") || question.includes("coût")) {
                return "Pour connaître mes tarifs, je vous invite à me contacter directement. Les prix varient selon la complexité et la durée du projet.";
            }
            if (question.includes("urgent") || question.includes("vite")) {
                return "Je peux m'adapter aux projets urgents. Contactez-moi directement pour discuter de votre timeline et de vos besoins spécifiques.";
            }
            if (question.includes("formation") || question.includes("apprentissage")) {
                return "Je propose également des services de formation technique et d'accompagnement d'équipes. Contactez-moi pour en savoir plus sur les programmes disponibles.";
            }
            if (question.includes("consulting") || question.includes("conseil")) {
                return "Je offre des services de conseil technique pour optimiser vos applications existantes ou définir votre architecture. N'hésitez pas à me contacter pour un audit.";
            }
            return "C'est une excellente question ! Pour une réponse détaillée adaptée à vos besoins, je vous invite à me contacter directement via le formulaire ou WhatsApp.";
        }
        
        // Suggestions buttons
        document.querySelectorAll('.suggestion-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const suggestion = btn.getAttribute('data-suggestion');
                input.value = suggestion;
                sendMessage();
            });
        });
        
        send.addEventListener("click", sendMessage);
        input.addEventListener("keypress", (e) => {
            if (e.key === "Enter") sendMessage();
        });

        const reveals = document.querySelectorAll(".reveal");
        const io = new IntersectionObserver((entries) => {
            entries.forEach((e) => e.target.classList.toggle("show", e.isIntersecting));
        }, { threshold: 0.1 });
        reveals.forEach((el) => io.observe(el));
    </script>
    
    <style>
        .typing-cursor {
            animation: blink 1s infinite;
        }
        
        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }
        
        .suggestion-btn:hover {
            background-color: var(--brand-yellow) !important;
            color: var(--brand-black) !important;
            transform: translateY(-1px);
        }
    </style>
</body>
</html>
