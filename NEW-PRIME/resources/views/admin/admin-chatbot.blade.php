{{-- AI Chatbot --}}
<button class="chatbot-toggle" id="chatbot-toggle" aria-label="Open AI Assistant">
    <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
</button>

<div class="chatbot-window" id="chatbot-window">
    <div class="chatbot-header">
        <div>
            <p style="font-weight:600;color:#fff;margin:0;font-size:14px">AI Assistant</p>
            <p style="font-size:11px;color:rgba(255,255,255,0.8);margin:0">PRIME HRIS Helper</p>
        </div>
        <button class="chatbot-close" id="chatbot-close">
            <svg width="16" height="16" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
    </div>
    <div class="chatbot-messages" id="chatbot-messages">
        <div class="chatbot-message bot">
            <div class="message-avatar">AI</div>
            <div class="message-content">Hello! I'm your PRIME HRIS assistant. How can I help you today?</div>
        </div>
    </div>
    <div class="chatbot-input-wrap">
        <input type="text" class="chatbot-input" id="chatbot-input" placeholder="Type your message...">
        <button class="chatbot-send" id="chatbot-send">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
        </button>
    </div>
</div>

<script>
    // Chatbot
    const chatToggle = document.getElementById('chatbot-toggle');
    const chatWindow = document.getElementById('chatbot-window');
    const chatClose = document.getElementById('chatbot-close');
    const chatInput = document.getElementById('chatbot-input');
    const chatSend = document.getElementById('chatbot-send');
    const chatMessages = document.getElementById('chatbot-messages');

    chatToggle.addEventListener('click', () => {
        chatWindow.classList.add('active');
        chatToggle.style.display = 'none';
    });

    chatClose.addEventListener('click', () => {
        chatWindow.classList.remove('active');
        chatToggle.style.display = 'flex';
    });

    function sendMessage() {
        const msg = chatInput.value.trim();
        if (!msg) return;
        
        chatMessages.innerHTML += `<div class="chatbot-message user"><div class="message-content">${msg}</div></div>`;
        chatInput.value = '';
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        setTimeout(() => {
            chatMessages.innerHTML += `<div class="chatbot-message bot"><div class="message-avatar">AI</div><div class="message-content">I'm processing your request about "${msg}". This is a demo response.</div></div>`;
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 800);
    }

    chatSend.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendMessage();
    });
</script>
