@props([
    'isOpen' => false
])

<!-- AI Chat Component -->
<div id="aiChatContainer" class="ai-chat-container" {{ $isOpen ? 'style="display: flex;"' : '' }}>
    <div class="ai-chat-panel">
        <!-- Header -->
        <div class="ai-chat-header">
            <div class="d-flex align-items-center">
                <div class="ai-avatar me-3">
                    <div class="ai-avatar-inner">
                        <i class="bi bi-robot"></i>
                        <span class="ai-status-indicator"></span>
                    </div>
                </div>
                <div class="ai-header-info">
                    <h6 class="mb-0">Assistant IA</h6>
                    <small class="ai-status-text">En ligne • Expert Full Stack</small>
                </div>
            </div>
            <div class="ai-header-actions">
                <button class="btn btn-icon ai-action-btn" id="aiClearBtn" title="Effacer conversation">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <button class="btn btn-icon ai-action-btn" id="aiMinimizeBtn" title="Minimiser">
                    <i class="bi bi-dash-lg"></i>
                </button>
            </div>
        </div>

        <!-- Debug Panel -->
        <div class="ai-debug-panel" id="aiDebugPanel" style="display: none;">
            <div class="ai-debug-header">
                <h6>🔍 Debug Mode</h6>
                <button class="btn btn-sm btn-outline-light" id="toggleDebug">Masquer</button>
            </div>
            <div class="ai-debug-content">
                <div class="debug-item">
                    <span class="debug-label">Statut API:</span>
                    <span class="debug-value" id="apiStatus">En attente...</span>
                </div>
                <div class="debug-item">
                    <span class="debug-label">Dernière requête:</span>
                    <span class="debug-value" id="lastRequest">Aucune</span>
                </div>
                <div class="debug-item">
                    <span class="debug-label">Temps réponse:</span>
                    <span class="debug-value" id="responseTime">0ms</span>
                </div>
                <div class="debug-item">
                    <span class="debug-label">Erreur:</span>
                    <span class="debug-value" id="lastError">Aucune</span>
                </div>
                <div class="debug-item">
                    <span class="debug-label">Contenu réponse:</span>
                    <span class="debug-value" id="responseContent">Vide</span>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="ai-chat-messages" id="aiChatMessages">
            <div class="ai-welcome-message">
                <div class="ai-avatar-small">
                    <i class="bi bi-robot"></i>
                </div>
                <div class="ai-message-content">
                    <div class="ai-message-text">
                        Bonjour ! Je suis l'assistant IA de cet ingénieur full stack. Je peux vous parler de ses compétences, projets, services ou répondre à vos questions techniques.
                    </div>
                    <div class="ai-suggestions">
                        <span class="ai-suggestion-label">Suggestions rapides :</span>
                        <div class="ai-suggestion-chips">
                            <button class="ai-suggestion-chip" data-suggestion="Compétences techniques">
                                <i class="bi bi-code-slash"></i> Compétences
                            </button>
                            <button class="ai-suggestion-chip" data-suggestion="Projets réalisés">
                                <i class="bi bi-folder"></i> Projets
                            </button>
                            <button class="ai-suggestion-chip" data-suggestion="Services proposés">
                                <i class="bi bi-gear"></i> Services
                            </button>
                            <button class="ai-suggestion-chip" data-suggestion="Contact et disponibilité">
                                <i class="bi bi-envelope"></i> Contact
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input -->
        <div class="ai-chat-input">
            <div class="ai-input-container">
                <textarea 
                    id="aiChatInput" 
                    class="ai-input-field" 
                    placeholder="Écrivez votre message..."
                    rows="1"
                    maxlength="1000"
                ></textarea>
                <div class="ai-input-actions">
                    <button class="btn btn-icon ai-send-btn" id="aiSendBtn" disabled>
                        <i class="bi bi-send"></i>
                    </button>
                </div>
            </div>
            <div class="ai-input-info">
                <span class="ai-input-hint">Appuyez sur Entrée pour envoyer, Shift+Entrée pour nouvelle ligne</span>
            </div>
        </div>
    </div>
</div>

<!-- Floating AI Button -->
<button class="ai-floating-button" id="aiFloatingBtn" {{ $isOpen ? 'style="display: none;"' : '' }}>
    <div class="ai-floating-inner">
        <i class="bi bi-robot"></i>
        <span class="ai-pulse"></span>
    </div>
</button>

<!-- Debug Toggle Button -->
<button class="ai-debug-toggle" id="debugToggleBtn" title="Activer/Désactiver Debug Mode">
    <i class="bi bi-bug"></i>
</button>

<style>
/* AI Chat Container */
.ai-chat-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 380px;
    height: 600px;
    z-index: 9999;
    display: none;
    flex-direction: column;
}

/* Glassmorphism Effect */
.ai-chat-panel {
    background: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 215, 0, 0.3);
    border-radius: 16px;
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

/* Debug Panel */
.ai-debug-panel {
    background: rgba(255, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 215, 0, 0.2);
    padding: 12px;
    border-radius: 8px;
    margin: 8px 16px;
}

.ai-debug-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.ai-debug-header h6 {
    color: #FFD700;
    font-size: 12px;
    margin: 0;
}

.ai-debug-content {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.debug-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 4px 8px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 4px;
}

.debug-label {
    color: rgba(255, 255, 255, 0.7);
    font-size: 11px;
    font-weight: 500;
}

.debug-value {
    color: #FFD700;
    font-size: 11px;
    font-family: monospace;
}

.ai-debug-toggle {
    position: fixed;
    top: 20px;
    right: 90px;
    width: 40px;
    height: 40px;
    background: rgba(255, 0, 0, 0.8);
    border: 1px solid rgba(255, 215, 0, 0.3);
    border-radius: 50%;
    color: #FFD700;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9998;
    cursor: pointer;
    transition: all 0.3s ease;
}

.ai-debug-toggle:hover {
    background: rgba(255, 0, 0, 0.9);
    border-color: #FFD700;
    transform: scale(1.1);
}

/* Header */
.ai-chat-header {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 215, 0, 0.05));
    border-bottom: 1px solid rgba(255, 215, 0, 0.2);
    padding: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.ai-avatar {
    position: relative;
}

.ai-avatar-inner {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000;
    font-size: 18px;
    position: relative;
}

.ai-status-indicator {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 12px;
    height: 12px;
    background: #22c55e;
    border: 2px solid rgba(0, 0, 0, 0.85);
    border-radius: 50%;
    animation: aiPulse 2s infinite;
}

.ai-header-info h6 {
    color: #FFD700;
    font-weight: 600;
    font-size: 14px;
}

.ai-status-text {
    color: #fff;
    opacity: 0.8;
    font-size: 12px;
}

.ai-action-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #fff;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    margin-left: 8px;
    transition: all 0.3s ease;
}

.ai-action-btn:hover {
    background: rgba(255, 215, 0, 0.2);
    border-color: rgba(255, 215, 0, 0.4);
    color: #FFD700;
    transform: translateY(-1px);
}

/* Messages */
.ai-chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.ai-welcome-message {
    display: flex;
    gap: 12px;
}

.ai-avatar-small {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000;
    font-size: 14px;
    flex-shrink: 0;
}

.ai-message-content {
    flex: 1;
}

.ai-message-text {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 12px 16px;
    color: #fff;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 12px;
}

.ai-suggestions {
    margin-top: 8px;
}

.ai-suggestion-label {
    color: #FFD700;
    font-size: 12px;
    font-weight: 500;
    display: block;
    margin-bottom: 8px;
    opacity: 0.8;
}

.ai-suggestion-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.ai-suggestion-chip {
    background: rgba(255, 215, 0, 0.1);
    border: 1px solid rgba(255, 215, 0, 0.3);
    color: #FFD700;
    border-radius: 20px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 4px;
}

.ai-suggestion-chip:hover {
    background: rgba(255, 215, 0, 0.2);
    border-color: #FFD700;
    transform: translateY(-1px);
}

/* User Message */
.ai-user-message {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

.ai-user-message .ai-message-text {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 215, 0, 0.1));
    border-color: rgba(255, 215, 0, 0.4);
    color: #fff;
}

/* AI Message */
.ai-ai-message {
    display: flex;
    gap: 12px;
}

.ai-ai-message .ai-message-text {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
}

/* Typing Indicator */
.ai-typing-indicator {
    display: flex;
    gap: 4px;
    padding: 8px 0;
}

.ai-typing-dot {
    width: 8px;
    height: 8px;
    background: #FFD700;
    border-radius: 50%;
    animation: aiTyping 1.4s infinite ease-in-out;
}

.ai-typing-dot:nth-child(2) {
    animation-delay: 0.2s;
}

.ai-typing-dot:nth-child(3) {
    animation-delay: 0.4s;
}

/* Input */
.ai-chat-input {
    background: rgba(0, 0, 0, 0.5);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding: 16px;
}

.ai-input-container {
    display: flex;
    align-items: flex-end;
    gap: 8px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 8px;
    transition: all 0.3s ease;
}

.ai-input-container:focus-within {
    border-color: rgba(255, 215, 0, 0.4);
    background: rgba(255, 255, 255, 0.08);
}

.ai-input-field {
    flex: 1;
    background: transparent;
    border: none;
    color: #fff;
    font-size: 14px;
    resize: none;
    outline: none;
    font-family: inherit;
    line-height: 1.4;
    max-height: 100px;
}

.ai-input-field::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.ai-send-btn {
    background: linear-gradient(135deg, #FFD700, #FFA500);
    border: none;
    color: #000;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.ai-send-btn:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
}

.ai-send-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.ai-input-info {
    margin-top: 8px;
    text-align: center;
}

.ai-input-hint {
    color: rgba(255, 255, 255, 0.5);
    font-size: 11px;
}

/* Floating Button */
.ai-floating-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 9998;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(255, 215, 0, 0.3);
}

.ai-floating-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
}

.ai-floating-inner {
    position: relative;
    color: #000;
    font-size: 24px;
}

.ai-pulse {
    position: absolute;
    top: -2px;
    right: -2px;
    width: 12px;
    height: 12px;
    background: #22c55e;
    border: 2px solid rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    animation: aiPulse 2s infinite;
}

/* Animations */
@keyframes aiPulse {
    0%, 60%, 100% {
        transform: translateY(0);
        opacity: 0.5;
    }
    30% {
        transform: translateY(-10px);
        opacity: 1;
    }
}

@keyframes aiTyping {
    0%, 60%, 100% {
        transform: translateY(0);
        opacity: 0.5;
    }
    30% {
        transform: translateY(-10px);
        opacity: 1;
    }
}

/* Scrollbar Styling */
.ai-chat-messages::-webkit-scrollbar {
    width: 6px;
}

.ai-chat-messages::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
}

.ai-chat-messages::-webkit-scrollbar-thumb {
    background: rgba(255, 215, 0, 0.3);
    border-radius: 3px;
}

.ai-chat-messages::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 215, 0, 0.5);
}

/* Responsive */
@media (max-width: 480px) {
    .ai-chat-container {
        width: calc(100vw - 40px);
        height: calc(100vh - 120px);
        bottom: 10px;
        right: 10px;
        left: 10px;
    }
    
    .ai-chat-panel {
        border-radius: 12px;
    }
    
    .ai-debug-toggle {
        top: 10px;
        right: 10px;
        width: 36px;
        height: 36px;
    }
}
</style>

<script>
class AIChatManager {
    constructor() {
        this.isOpen = false;
        this.isTyping = false;
        this.conversationHistory = [];
        this.debugMode = false;
        
        this.initElements();
        this.initEventListeners();
        this.loadConversation();
    }

    initElements() {
        this.container = document.getElementById('aiChatContainer');
        this.messagesContainer = document.getElementById('aiChatMessages');
        this.input = document.getElementById('aiChatInput');
        this.sendBtn = document.getElementById('aiSendBtn');
        this.floatingBtn = document.getElementById('aiFloatingBtn');
        this.clearBtn = document.getElementById('aiClearBtn');
        this.minimizeBtn = document.getElementById('aiMinimizeBtn');
        this.debugPanel = document.getElementById('aiDebugPanel');
        this.debugToggle = document.getElementById('debugToggleBtn');
        this.toggleDebugBtn = document.getElementById('toggleDebug');
    }

    initEventListeners() {
        // Chat controls
        this.floatingBtn.addEventListener('click', () => this.toggleChat());
        this.minimizeBtn.addEventListener('click', () => this.closeChat());
        this.clearBtn.addEventListener('click', () => this.clearConversation());
        
        // Message sending
        this.sendBtn.addEventListener('click', () => this.sendMessage());
        this.input.addEventListener('keydown', (e) => this.handleKeyDown(e));
        this.input.addEventListener('input', () => this.handleInput());
        
        // Debug controls
        this.debugToggle.addEventListener('click', () => this.toggleDebugMode());
        if (this.toggleDebugBtn) {
            this.toggleDebugBtn.addEventListener('click', () => this.toggleDebugMode());
        }
        
        // Suggestion chips
        document.querySelectorAll('.ai-suggestion-chip').forEach(chip => {
            chip.addEventListener('click', () => {
                const suggestion = chip.getAttribute('data-suggestion');
                this.input.value = suggestion;
                this.sendMessage();
            });
        });
    }

    toggleChat() {
        this.isOpen = !this.isOpen;
        if (this.isOpen) {
            this.openChat();
        } else {
            this.closeChat();
        }
    }

    openChat() {
        this.container.style.display = 'flex';
        this.floatingBtn.style.display = 'none';
        this.input.focus();
    }

    closeChat() {
        this.container.style.display = 'none';
        this.floatingBtn.style.display = 'flex';
    }

    handleKeyDown(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            this.sendMessage();
        } else if (e.key === 'Enter' && e.shiftKey) {
            e.preventDefault();
            this.input.value += '\n';
        }
    }

    handleInput() {
        this.sendBtn.disabled = !this.input.value.trim();
    }

    async sendMessage() {
        const message = this.input.value.trim();
        if (!message || this.isTyping) return;

        // Add user message
        this.addMessage(message, 'user');
        this.input.value = '';
        this.handleInput();

        // Show typing
        this.showTyping();

        try {
            // Debug: Log request
            this.updateDebugInfo('sending', message);
            
            const startTime = Date.now();
            
            // Send to API
            const response = await this.sendToAPI(message);
            
            const endTime = Date.now();
            const responseTime = endTime - startTime;
            
            // Debug: Log response
            this.updateDebugInfo('success', response, responseTime);
            
            // Add AI response
            if (response && response.response) {
                this.addMessage(response.response, 'assistant');
                this.updateSuggestions(response.suggestions || []);
            } else {
                this.addMessage('Je n\'ai pas pu traiter votre demande. Veuillez réessayer avec une autre question.', 'assistant');
                this.updateDebugInfo('error', 'Empty or invalid response', responseTime);
            }
            
        } catch (error) {
            console.error('AI Chat Error:', error);
            this.addMessage('Je rencontre une difficulté technique. Veuillez réessayer dans un instant.', 'assistant');
            this.updateDebugInfo('error', error.message, Date.now() - startTime);
        } finally {
            this.hideTyping();
        }
    }

    async sendToAPI(message) {
        // Remove CSRF token for debugging
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        // Debug: Log request details
        console.log('🔍 API Request Details:', {
            url: '/api/ai/chat',
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            payload: {
                message: message,
                context: this.conversationHistory.slice(-5)
            },
            timestamp: new Date().toISOString()
        });
        
        try {
            const response = await fetch('/api/ai/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: message,
                    context: this.conversationHistory.slice(-5)
                })
            });

            // Debug: Log response details
            console.log('🔍 API Response Details:', {
                status: response.status,
                statusText: response.statusText,
                ok: response.ok,
                headers: Object.fromEntries(response.headers.entries()),
                timestamp: new Date().toISOString()
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();
            
            // Debug: Log parsed data
            console.log('🔍 Parsed Response Data:', {
                data: data,
                hasResponse: !!data.response,
                responseType: typeof data.response,
                responseLength: data.response ? data.response.length : 0,
                timestamp: new Date().toISOString()
            });
            
            return data;
            
        } catch (error) {
            console.error('🔍 API Fetch Error:', {
                error: error.message,
                stack: error.stack,
                timestamp: new Date().toISOString()
            });
            throw error;
        }
    }

    addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `ai-${sender}-message`;
        
        const avatar = document.createElement('div');
        avatar.className = 'ai-avatar-small';
        avatar.innerHTML = sender === 'user' ? '<i class="bi bi-person"></i>' : '<i class="bi bi-robot"></i>';
        
        const content = document.createElement('div');
        content.className = 'ai-message-content';
        content.innerHTML = `<div class="ai-message-text">${this.escapeHtml(text)}</div>`;
        
        messageDiv.appendChild(avatar);
        messageDiv.appendChild(content);
        this.messagesContainer.appendChild(messageDiv);
        
        // Scroll to bottom
        this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
        
        // Add to history
        this.conversationHistory.push({ text, sender, timestamp: new Date() });
        this.saveConversation();
    }

    showTyping() {
        if (this.isTyping) return;
        
        this.isTyping = true;
        const typingDiv = document.createElement('div');
        typingDiv.className = 'ai-ai-message';
        typingDiv.id = 'typingIndicator';
        
        const avatar = document.createElement('div');
        avatar.className = 'ai-avatar-small';
        avatar.innerHTML = '<i class="bi bi-robot"></i>';
        
        const content = document.createElement('div');
        content.className = 'ai-message-content';
        content.innerHTML = `
            <div class="ai-typing-indicator">
                <div class="ai-typing-dot"></div>
                <div class="ai-typing-dot"></div>
                <div class="ai-typing-dot"></div>
            </div>
        `;
        
        typingDiv.appendChild(avatar);
        typingDiv.appendChild(content);
        this.messagesContainer.appendChild(typingDiv);
        this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
    }

    hideTyping() {
        this.isTyping = false;
        const typingIndicator = document.getElementById('typingIndicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

    clearConversation() {
        this.messagesContainer.innerHTML = '';
        this.conversationHistory = [];
        this.saveConversation();
        
        // Re-add welcome message
        this.addWelcomeMessage();
    }

    addWelcomeMessage() {
        const welcomeDiv = document.createElement('div');
        welcomeDiv.className = 'ai-welcome-message';
        welcomeDiv.innerHTML = `
            <div class="ai-avatar-small">
                <i class="bi bi-robot"></i>
            </div>
            <div class="ai-message-content">
                <div class="ai-message-text">
                    Bonjour ! Je suis l'assistant IA de cet ingénieur full stack. Je peux vous parler de ses compétences, projets, services ou répondre à vos questions techniques.
                </div>
                <div class="ai-suggestions">
                    <span class="ai-suggestion-label">Suggestions rapides :</span>
                    <div class="ai-suggestion-chips">
                        <button class="ai-suggestion-chip" data-suggestion="Compétences techniques">
                            <i class="bi bi-code-slash"></i> Compétences
                        </button>
                        <button class="ai-suggestion-chip" data-suggestion="Projets réalisés">
                            <i class="bi bi-folder"></i> Projets
                        </button>
                        <button class="ai-suggestion-chip" data-suggestion="Services proposés">
                            <i class="bi bi-gear"></i> Services
                        </button>
                        <button class="ai-suggestion-chip" data-suggestion="Contact et disponibilité">
                            <i class="bi bi-envelope"></i> Contact
                        </button>
                    </div>
                </div>
            </div>
        `;
        this.messagesContainer.appendChild(welcomeDiv);
    }

    toggleDebugMode() {
        this.debugMode = !this.debugMode;
        if (this.debugPanel) {
            this.debugPanel.style.display = this.debugMode ? 'block' : 'none';
        }
        console.log('Debug mode:', this.debugMode ? 'ON' : 'OFF');
    }

    updateDebugInfo(status, data, responseTime = null) {
        if (!this.debugMode) return;
        
        const apiStatusEl = document.getElementById('apiStatus');
        const lastRequestEl = document.getElementById('lastRequest');
        const responseTimeEl = document.getElementById('responseTime');
        const lastErrorEl = document.getElementById('lastError');
        const responseContentEl = document.getElementById('responseContent');
        
        if (apiStatusEl) {
            apiStatusEl.textContent = status === 'sending' ? 'Envoi...' : status === 'success' ? '✅ Succès' : '❌ Erreur';
            apiStatusEl.style.color = status === 'success' ? '#22c55e' : '#ef4444';
        }
        
        if (lastRequestEl) {
            lastRequestEl.textContent = typeof data === 'string' ? data.substring(0, 30) + '...' : JSON.stringify(data).substring(0, 30) + '...';
        }
        
        if (responseTimeEl && responseTime) {
            responseTimeEl.textContent = `${responseTime}ms`;
        }
        
        if (lastErrorEl) {
            lastErrorEl.textContent = status === 'error' ? (data || 'Erreur inconnue') : 'Aucune';
            lastErrorEl.style.color = status === 'error' ? '#ef4444' : '#22c55e';
        }
        
        if (responseContentEl) {
            const content = data?.response || 'Vide';
            responseContentEl.textContent = content.length > 50 ? content.substring(0, 50) + '...' : content;
        }
    }

    updateSuggestions(suggestions) {
        // Update suggestion chips if needed
        // This could be extended to dynamically update suggestions
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    saveConversation() {
        localStorage.setItem('aiChatHistory', JSON.stringify(this.conversationHistory));
    }

    loadConversation() {
        const saved = localStorage.getItem('aiChatHistory');
        if (saved) {
            try {
                this.conversationHistory = JSON.parse(saved);
            } catch (e) {
                this.conversationHistory = [];
            }
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new AIChatManager();
});
</script>
