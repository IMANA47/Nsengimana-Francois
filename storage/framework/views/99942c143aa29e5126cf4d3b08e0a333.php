<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'isOpen' => false
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'isOpen' => false
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!-- AI Chat Component -->
<div id="aiChatContainer" class="ai-chat-container" style="display: none !important;">
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
                    <h6 class="mb-0">Imana47 IA</h6>
                    <small class="ai-status-text">En ligne • Dev Full Stack</small>
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

        
        <!-- Messages -->
        <div class="ai-chat-messages" id="aiChatMessages">
            <div class="ai-welcome-message">
                <div class="ai-avatar-small">
                    <i class="bi bi-robot"></i>
                </div>
                <div class="ai-message-content">
                    <div class="ai-message-text">
                        Bonjour ! Je suis l'assistant IA du portfolio. Je peux vous parler de ses compétences, projets, services ou répondre à vos questions techniques.
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
<button class="ai-floating-button" id="aiFloatingBtn" <?php echo e($isOpen ? 'style="display: none;"' : ''); ?> style="display: flex !important; position: fixed !important; bottom: 20px !important; right: 20px !important; width: 60px !important; height: 60px !important; background: linear-gradient(135deg, #FFD700, #FFA500) !important; border: none !important; border-radius: 50% !important; color: #000000 !important; font-size: 24px !important; font-weight: bold !important; z-index: 9999 !important; cursor: pointer !important; box-shadow: 0 4px 16px rgba(255, 215, 0, 0.4) !important; transition: all 0.3s ease !important;">
    <div class="ai-floating-inner" style="display: flex !important; align-items: center !important; justify-content: center !important; width: 100% !important; height: 100% !important;">
        <i class="bi bi-robot" style="color: #000000 !important; font-size: 24px !important; font-weight: bold !important;"></i>
        <span class="ai-pulse" style="position: absolute !important; top: -2px !important; right: -2px !important; width: 12px !important; height: 12px !important; background: #22c55e !important; border: 2px solid rgba(255, 255, 255, 0.9) !important; border-radius: 50% !important; animation: aiPulse 2s infinite !important;"></span>
    </div>
</button>


<style>
/* AI Chat Container */
.ai-chat-container {
    position: fixed;
    bottom: var(--space-5);
    right: var(--space-5);
    width: var(--ai-chat-width);
    height: var(--ai-chat-height);
    z-index: var(--z-max);
    display: none;
    flex-direction: column;
    opacity: 1;
    visibility: visible;
    transition: all var(--transition-normal);
}

/* Glassmorphism Effect */
.ai-chat-panel {
    background: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 215, 0, 0.3);
    border-radius: var(--ai-chat-border-radius);
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow: var(--shadow-2xl);
}

/* Fallback for browsers that don't support backdrop-filter */
@supports not (backdrop-filter: blur(20px)) {
    .ai-chat-panel {
        background: rgba(0, 0, 0, 0.95);
    }
}


/* Header */
.ai-chat-header {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 215, 0, 0.05));
    border-bottom: 1px solid rgba(255, 215, 0, 0.2);
    padding: var(--space-4);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-shrink: 0;
}

.ai-avatar {
    position: relative;
}

.ai-avatar-inner {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--brand-yellow), #FFA500);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--brand-black);
    font-size: var(--font-size-lg);
    position: relative;
    transition: transform var(--transition-normal);
}

.ai-avatar:hover .ai-avatar-inner {
    transform: scale(1.05);
}

.ai-status-indicator {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 12px;
    height: 12px;
    background: var(--color-success);
    border: 2px solid rgba(0, 0, 0, 0.85);
    border-radius: var(--radius-full);
    animation: aiPulse 2s infinite;
}

.ai-header-info h6 {
    color: var(--brand-yellow);
    font-weight: var(--font-weight-semibold);
    font-size: var(--font-size-sm);
    margin: 0;
}

.ai-status-text {
    color: var(--brand-white);
    opacity: 0.8;
    font-size: var(--font-size-xs);
    margin: 0;
}

.ai-action-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--brand-white);
    width: 32px;
    height: 32px;
    border-radius: var(--radius-md);
    margin-left: var(--space-2);
    transition: all var(--transition-normal);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    min-height: 44px;
    min-width: 44px;
}

.ai-action-btn:hover {
    background: rgba(255, 215, 0, 0.2);
    border-color: rgba(255, 215, 0, 0.4);
    color: var(--brand-yellow);
    transform: translateY(-1px);
}

.ai-action-btn:focus {
    outline: var(--focus-width) solid var(--focus-color);
    outline-offset: var(--focus-offset);
}

/* Messages */
.ai-chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: var(--space-4);
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.ai-welcome-message {
    display: flex;
    gap: var(--space-3);
}

.ai-avatar-small {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, var(--brand-yellow), #FFA500);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--brand-black);
    font-size: var(--font-size-sm);
    flex-shrink: 0;
}

.ai-message-content {
    flex: 1;
    max-width: var(--ai-message-max-width);
}

.ai-message-text {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius-xl);
    padding: var(--space-3) var(--space-4);
    color: var(--brand-white);
    font-size: var(--font-size-sm);
    line-height: var(--line-height-normal);
    margin-bottom: var(--space-3);
    word-wrap: break-word;
}

.ai-suggestions {
    margin-top: var(--space-2);
}

.ai-suggestion-label {
    color: var(--brand-yellow);
    font-size: var(--font-size-xs);
    font-weight: var(--font-weight-medium);
    display: block;
    margin-bottom: var(--space-2);
    opacity: 0.8;
}

.ai-suggestion-chips {
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-2);
}

.ai-suggestion-chip {
    background: rgba(255, 215, 0, 0.1);
    border: 1px solid rgba(255, 215, 0, 0.3);
    color: var(--brand-yellow);
    border-radius: var(--radius-full);
    padding: var(--space-2) var(--space-3);
    font-size: var(--font-size-xs);
    font-weight: var(--font-weight-medium);
    cursor: pointer;
    transition: all var(--transition-normal);
    display: flex;
    align-items: center;
    gap: var(--space-1);
    min-height: 32px;
    white-space: nowrap;
}

.ai-suggestion-chip:hover {
    background: rgba(255, 215, 0, 0.2);
    border-color: var(--brand-yellow);
    transform: translateY(-1px);
}

.ai-suggestion-chip:focus {
    outline: var(--focus-width) solid var(--focus-color);
    outline-offset: var(--focus-offset);
}

/* User Message */
.ai-user-message {
    display: flex;
    justify-content: flex-end;
    gap: var(--space-3);
}

.ai-user-message .ai-message-content {
    max-width: var(--ai-message-max-width);
}

.ai-user-message .ai-message-text {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 215, 0, 0.1));
    border-color: rgba(255, 215, 0, 0.4);
    color: var(--brand-white);
}

/* AI Message */
.ai-ai-message {
    display: flex;
    gap: var(--space-3);
}

.ai-ai-message .ai-message-text {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
}

/* Typing Indicator */
.ai-typing-indicator {
    display: flex;
    gap: var(--space-1);
    padding: var(--space-2) 0;
}

.ai-typing-dot {
    width: 8px;
    height: 8px;
    background: var(--brand-yellow);
    border-radius: var(--radius-full);
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
    padding: var(--space-4);
    flex-shrink: 0;
}

.ai-input-container {
    display: flex;
    align-items: flex-end;
    gap: var(--space-2);
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius-xl);
    padding: var(--space-2);
    transition: all var(--transition-normal);
}

.ai-input-container:focus-within {
    border-color: rgba(255, 215, 0, 0.4);
    background: rgba(255, 255, 255, 0.08);
}

.ai-input-field {
    flex: 1;
    background: transparent;
    border: none;
    color: var(--brand-white);
    font-size: var(--font-size-sm);
    resize: none;
    outline: none;
    font-family: inherit;
    line-height: var(--line-height-normal);
    max-height: 100px;
    min-height: 20px;
}

.ai-input-field::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.ai-input-field:focus {
    outline: none;
}

.ai-send-btn {
    background: linear-gradient(135deg, var(--brand-yellow), #FFA500);
    border: none;
    color: var(--brand-black);
    width: 36px;
    height: 36px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--transition-normal);
    cursor: pointer;
    min-height: 44px;
    min-width: 44px;
}

.ai-send-btn:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: var(--shadow-brand);
}

.ai-send-btn:focus {
    outline: var(--focus-width) solid var(--focus-color);
    outline-offset: var(--focus-offset);
}

.ai-send-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.ai-input-info {
    margin-top: var(--space-2);
    text-align: center;
}

.ai-input-hint {
    color: rgba(255, 255, 255, 0.5);
    font-size: var(--font-size-xs);
}

/* Floating Button */
.ai-floating-button {
    position: fixed;
    bottom: var(--space-5);
    right: var(--space-5);
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--brand-yellow), #FFA500);
    border: none;
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: var(--z-fixed);
    transition: all var(--transition-normal);
    box-shadow: var(--shadow-lg);
    min-height: 60px;
    min-width: 60px;
}

.ai-floating-button:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-xl);
}

.ai-floating-button:focus {
    outline: var(--focus-width) solid var(--focus-color);
    outline-offset: var(--focus-offset);
}

.ai-floating-inner {
    position: relative;
    color: var(--brand-black);
    font-size: var(--font-size-2xl);
}

.ai-pulse {
    position: absolute;
    top: -2px;
    right: -2px;
    width: 12px;
    height: 12px;
    background: var(--color-success);
    border: 2px solid rgba(255, 255, 255, 0.8);
    border-radius: var(--radius-full);
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
    border-radius: var(--radius-sm);
}

.ai-chat-messages::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 215, 0, 0.5);
}

/* Responsive Design */
@media (max-width: 480px) {
    .ai-chat-container {
        width: calc(100vw - var(--space-8));
        height: calc(100vh - 120px);
        bottom: var(--space-3);
        right: var(--space-3);
        left: var(--space-3);
    }
    
    .ai-chat-panel {
        border-radius: var(--radius-xl);
    }
    
    .ai-chat-header {
        padding: var(--space-3);
    }
    
    .ai-chat-messages {
        padding: var(--space-3);
        gap: var(--space-3);
    }
    
    .ai-message-text {
        padding: var(--space-3);
        font-size: var(--font-size-xs);
    }
    
    .ai-chat-input {
        padding: var(--space-3);
    }
    
    .ai-input-container {
        padding: var(--space-2);
        gap: var(--space-2);
    }
    
    .ai-send-btn {
        width: 32px;
        height: 32px;
        min-height: 44px;
        min-width: 44px;
    }
    
    .ai-floating-button {
        width: 50px;
        height: 50px;
        bottom: var(--space-4);
        right: var(--space-4);
        min-height: 50px;
        min-width: 50px;
    }
    
    .ai-floating-inner {
        font-size: var(--font-size-xl);
    }
    
    .ai-pulse {
        width: 10px;
        height: 10px;
    }
}

@media (max-width: 320px) {
    .ai-chat-container {
        width: calc(100vw - var(--space-4));
        height: calc(100vh - 100px);
        bottom: var(--space-2);
        right: var(--space-2);
        left: var(--space-2);
    }
    
    .ai-suggestion-chips {
        gap: var(--space-1);
    }
    
    .ai-suggestion-chip {
        padding: var(--space-1) var(--space-2);
        font-size: 10px;
        min-height: 28px;
    }
}

/* Tablet Responsive */
@media (min-width: 481px) and (max-width: 768px) {
    .ai-chat-container {
        width: 350px;
        height: 500px;
        bottom: var(--space-4);
        right: var(--space-4);
    }
    
    .ai-floating-button {
        width: 55px;
        height: 55px;
        min-height: 55px;
        min-width: 55px;
    }
    
    .ai-floating-inner {
        font-size: var(--font-size-xl);
    }
}

/* Large Desktop */
@media (min-width: 1200px) {
    .ai-chat-container {
        width: 420px;
        height: 650px;
    }
}

/* Ultra-wide Desktop */
@media (min-width: 1600px) {
    .ai-chat-container {
        width: 450px;
        height: 700px;
    }
}

/* Accessibility - Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .ai-chat-container,
    .ai-chat-panel,
    .ai-floating-button,
    .ai-avatar-inner,
    .ai-suggestion-chip,
    .ai-send-btn,
    .ai-action-btn {
        transition: none;
        animation: none;
    }
    
    .ai-pulse,
    .ai-typing-dot {
        animation: none;
        opacity: 1;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .ai-chat-panel {
        background: rgba(0, 0, 0, 0.95);
        border: 2px solid var(--brand-yellow);
    }
    
    .ai-message-text {
        border: 1px solid var(--brand-gray);
    }
    
    .ai-suggestion-chip {
        border: 2px solid var(--brand-yellow);
    }
}
</style>

<script>
class AIChatManager {
    constructor() {
        this.isOpen = false;
        this.isTyping = false;
        this.conversationHistory = [];
        
        console.log('AI Chat Manager initialized');
        this.initElements();
        this.initEventListeners();
    }

    initElements() {
        this.container = document.getElementById('aiChatContainer');
        this.messagesContainer = document.getElementById('aiChatMessages');
        this.input = document.getElementById('aiChatInput');
        this.sendBtn = document.getElementById('aiSendBtn');
        this.floatingBtn = document.getElementById('aiFloatingBtn');
        this.clearBtn = document.getElementById('aiClearBtn');
        this.minimizeBtn = document.getElementById('aiMinimizeBtn');
        
        console.log('Elements initialized:', {
            container: !!this.container,
            input: !!this.input,
            sendBtn: !!this.sendBtn,
            floatingBtn: !!this.floatingBtn
        });
    }

    initEventListeners() {
        console.log('🔍 DEBUG: Initializing event listeners...');
        
        if (this.floatingBtn) {
            console.log('🔍 DEBUG: Floating button found:', this.floatingBtn);
            this.floatingBtn.addEventListener('click', (e) => {
                console.log('🔍 DEBUG: Click event triggered!', e);
                console.log('🔍 DEBUG: Current state before toggle:', this.isOpen);
                this.toggleChat();
            });
        } else {
            console.error('🚨 DEBUG: Floating button NOT found!');
        }
        
        if (this.minimizeBtn) {
            this.minimizeBtn.addEventListener('click', () => this.closeChat());
        }
        
        if (this.clearBtn) {
            this.clearBtn.addEventListener('click', () => this.clearConversation());
        }
        
        if (this.sendBtn) {
            this.sendBtn.addEventListener('click', () => this.sendMessage());
        }
        
        if (this.input) {
            this.input.addEventListener('keydown', (e) => this.handleKeyDown(e));
            this.input.addEventListener('input', () => this.handleInput());
        }
        
        // Suggestion chips
        document.querySelectorAll('.ai-suggestion-chip').forEach(chip => {
            chip.addEventListener('click', () => {
                const suggestion = chip.getAttribute('data-suggestion');
                if (this.input) {
                    this.input.value = suggestion;
                    this.sendMessage();
                }
            });
        });
        
        console.log('Event listeners initialized');
    }

    toggleChat() {
        console.log('🔍 DEBUG: Toggle chat called');
        console.log('🔍 DEBUG: State before toggle:', this.isOpen);
        
        this.isOpen = !this.isOpen;
        
        console.log('🔍 DEBUG: State after toggle:', this.isOpen);
        console.log('🔍 DEBUG: Container element:', this.container);
        console.log('🔍 DEBUG: Container styles before:', this.container ? this.container.style.cssText : 'NO CONTAINER');
        
        if (this.isOpen) {
            console.log('🔍 DEBUG: Opening chat...');
            this.openChat();
        } else {
            console.log('🔍 DEBUG: Closing chat...');
            this.closeChat();
        }
    }

    openChat() {
        console.log('� CORRECTION RADICALE - openChat() called');
        
        if (this.container) {
            // FORCAGE ABSOLU - Supprimer TOUTES les classes et styles
            this.container.className = '';
            this.container.removeAttribute('style');
            
            // Appliquer styles FORCÉS avec !important
            this.container.style.cssText = `
                position: fixed !important;
                bottom: 20px !important;
                right: 20px !important;
                top: auto !important;
                left: auto !important;
                transform: none !important;
                width: 380px !important;
                height: 600px !important;
                max-width: 90vw !important;
                max-height: 80vh !important;
                background: #1F2937 !important;
                border: 1px solid #FFD700 !important;
                border-radius: 16px !important;
                z-index: 9999 !important;
                display: flex !important;
                flex-direction: column !important;
                visibility: visible !important;
                opacity: 1 !important;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4) !important;
                backdrop-filter: blur(20px) !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2) !important;
            `;
            
            console.log('✅ Assistant IA stylisé avec design system');
            console.log('✅ Container dimensions:', {
                width: this.container.offsetWidth,
                height: this.container.offsetHeight,
                visible: this.container.offsetWidth > 0 && this.container.offsetHeight > 0
            });
        }
        
        if (this.floatingBtn) {
            this.floatingBtn.style.display = 'none';
        }
        
        if (this.input) {
            this.input.focus();
        }
        
        console.log('� CORRECTION RADICALE terminée');
    }

    closeChat() {
        console.log('🚨 FERMETURE - closeChat() called');
        
        if (this.container) {
            this.container.style.display = 'none';
        }
        if (this.floatingBtn) {
            this.floatingBtn.style.display = 'flex';
        }
        
        console.log('🚨 Chat fermé avec succès');
    }

    handleKeyDown(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            this.sendMessage();
        } else if (e.key === 'Enter' && e.shiftKey) {
            e.preventDefault();
            if (this.input) {
                this.input.value += '\n';
            }
        }
    }

    handleInput() {
        if (this.sendBtn && this.input) {
            this.sendBtn.disabled = !this.input.value.trim();
        }
    }

    async sendMessage() {
        const message = this.input ? this.input.value.trim() : '';
        if (!message || this.isTyping) return;

        console.log('Sending message:', message);

        // Add user message
        this.addMessage(message, 'user');
        if (this.input) {
            this.input.value = '';
        }
        this.handleInput();

        // Show typing
        this.showTyping();

        try {
            const startTime = Date.now();
            
            // Send to API
            const response = await this.sendToAPI(message);
            
            // Add AI response
            if (response && response.response) {
                this.addMessage(response.response, 'assistant');
            } else {
                this.addMessage('Je n\'ai pas pu traiter votre demande. Veuillez réessayer avec une autre question.', 'assistant');
            }
            
        } catch (error) {
            console.error('AI Chat Error:', error);
            this.addMessage('Je rencontre une difficulté technique. Veuillez réessayer dans un instant.', 'assistant');
        } finally {
            this.hideTyping();
        }
    }

    async sendToAPI(message) {
        console.log('🔍 Sending API request for:', message);
        
        try {
            const response = await fetch('/api/ai/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: message
                })
            });

            console.log('🔍 API Response status:', response.status, response.statusText);

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();
            console.log('🔍 API Response data:', data);
            
            return data;
            
        } catch (error) {
            console.error('🔍 API Fetch Error:', error);
            throw error;
        }
    }

    addMessage(text, sender) {
        if (!this.messagesContainer) return;
        
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
    }

    showTyping() {
        if (this.isTyping || !this.messagesContainer) return;
        
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
        if (!this.messagesContainer) return;
        
        this.messagesContainer.innerHTML = '';
        this.conversationHistory = [];
        
        // Re-add welcome message
        this.addWelcomeMessage();
    }

    addWelcomeMessage() {
        if (!this.messagesContainer) return;
        
        const welcomeDiv = document.createElement('div');
        welcomeDiv.className = 'ai-welcome-message';
        welcomeDiv.innerHTML = `
            <div class="ai-avatar-small">
                <i class="bi bi-robot"></i>
            </div>
            <div class="ai-message-content">
                <div class="ai-message-text">
                    Bonjour ! Je suis l'assistant IA du portfolio. Je peux vous parler de ses compétences, projets, services ou répondre à vos questions techniques.
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

    
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded, initializing AI Chat Manager');
    new AIChatManager();
});
</script>
<?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/components/ai-chat.blade.php ENDPATH**/ ?>