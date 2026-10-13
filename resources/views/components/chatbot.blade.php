{{-- ============================================================ --}}
{{-- WIDGET CHATBOT KELAS BADAK (POWERED BY AI)                  --}}
{{-- Alpine.js driven – smooth micro-interactions & animations    --}}
{{-- ============================================================ --}}

<style>
    /* Custom scrollbar – sleek CSIRT aesthetic */
    .csirt-scroll::-webkit-scrollbar { width: 5px; }
    .csirt-scroll::-webkit-scrollbar-track { background: transparent; }
    .csirt-scroll::-webkit-scrollbar-thumb { background: #3b82f6; border-radius: 10px; }
    .dark .csirt-scroll::-webkit-scrollbar-thumb { background: #1e3a8a; }

    /* Hide Alpine x-cloak elements before init */
    [x-cloak] { display: none !important; }

    /* Idle glow keyframe for the FAB when chat is closed */
    @keyframes csirt-glow-pulse {
        0%, 100% { box-shadow: 0 0 12px 2px rgba(59,130,246,0.45), 0 4px 14px rgba(0,0,0,0.35); }
        50%       { box-shadow: 0 0 22px 6px rgba(34,211,238,0.55), 0 4px 18px rgba(0,0,0,0.35); }
    }
    .csirt-fab-idle { animation: csirt-glow-pulse 2.8s ease-in-out infinite; }
    .csirt-fab-idle:hover { animation: none; }
</style>

<div
    x-data="{
        open: false,
        toggle() {
            this.open = !this.open;
            if (this.open) {
                this.$nextTick(() => {
                    const input = this.$el.querySelector('.csirt-input');
                    if (input) input.focus();
                });
            }
        },
        handleEsc(e) {
            if (e.key === 'Escape' && this.open) this.open = false;
        }
    }"
    @keydown.window="handleEsc($event)"
    class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-[9999] flex flex-col items-end"
>

    {{-- ── Chat Popup Window ─────────────────────────────────── --}}
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-90 translate-y-4"
        @click.outside="open = false"
        class="flex flex-col w-[calc(100vw-2rem)] sm:w-96 h-[calc(100vh-6rem)] max-h-[32rem]
               bg-white/95 dark:bg-slate-900/95
               backdrop-blur-xl rounded-2xl
               shadow-2xl dark:shadow-[0_0_40px_rgba(0,0,0,0.6)]
               border border-gray-200/50 dark:border-slate-700/60
               overflow-hidden mb-4
               origin-bottom-right"
    >
        {{-- Header ──────────────────────────────────────────── --}}
        <div class="shrink-0 bg-gradient-to-r from-blue-700 to-cyan-600 p-4 flex justify-between items-center text-white relative overflow-hidden">
            {{-- Ambient glow orb --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="flex items-center space-x-3 relative z-10">
                <div class="relative">
                    <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    {{-- Live status dot --}}
                    <span class="absolute -bottom-1 -right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500 border border-blue-700"></span>
                    </span>
                </div>
                <div>
                    <h3 class="font-bold text-sm tracking-wide">CSIRT Assistant</h3>
                    <p class="text-[10px] text-blue-100 font-mono tracking-widest uppercase">Secure AI Link</p>
                </div>
            </div>

            {{-- Close button (in header) --}}
            <button
                type="button"
                @click="open = false"
                class="relative z-10 p-1.5 bg-black/10 hover:bg-black/25 active:scale-90 rounded-md transition-all duration-150 cursor-pointer"
                aria-label="Tutup chatbot"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Messages Area ────────────────────────────────────── --}}
        <div class="csirt-bot-messages csirt-scroll flex-1 p-5 overflow-y-auto bg-gray-50/50 dark:bg-slate-950/50 flex flex-col text-sm">
            {{-- Initial AI greeting bubble --}}
            <div class="flex items-start mb-4">
                <div class="bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 text-gray-700 dark:text-gray-200 rounded-2xl rounded-tl-sm p-3.5 max-w-[85%] shadow-sm font-medium text-[13px] leading-relaxed">
                    Halo! Saya asisten AI JatimProv-CSIRT. Ada yang bisa saya bantu terkait informasi layanan atau pelaporan insiden siber?
                </div>
            </div>
        </div>

        {{-- Input Area ──────────────────────────────────────── --}}
        <div class="shrink-0 p-3 border-t border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 flex gap-2 items-center">
            <input
                type="text"
                autocomplete="off"
                onkeydown="csirtBotEnter(event, this)"
                class="csirt-input flex-1 bg-gray-100 dark:bg-slate-800 border-transparent focus:border-blue-500 focus:bg-white dark:focus:bg-slate-900 focus:ring-2 focus:ring-blue-500/50 rounded-xl px-4 py-2.5 text-sm text-gray-900 dark:text-white transition-all placeholder-gray-400 dark:placeholder-gray-500 outline-none"
                placeholder="Ketik pesan Anda..."
            >
            <button
                type="button"
                onclick="csirtBotClick(this)"
                class="bg-blue-600 hover:bg-cyan-500 active:scale-90 text-white p-2.5 rounded-xl transition-all duration-150 shadow-md hover:shadow-cyan-500/30 hover:-translate-y-0.5 cursor-pointer flex shrink-0"
                aria-label="Kirim pesan"
            >
                <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ── Floating Action Button (FAB) ─────────────────────── --}}
    <button
        type="button"
        @click="toggle()"
        :class="open ? 'scale-95' : 'csirt-fab-idle'"
        class="relative w-14 h-14
               bg-gradient-to-r from-blue-600 to-cyan-500
               hover:from-blue-500 hover:to-cyan-400
               active:scale-90
               text-white rounded-full
               flex items-center justify-center
               transition-all duration-300 ease-out
               hover:shadow-[0_0_20px_rgba(59,130,246,0.6)]
               border-2 border-white/10
               cursor-pointer pointer-events-auto
               overflow-hidden"
        aria-label="Buka / Tutup chatbot"
        :aria-expanded="open"
    >
        {{-- Background idle ping ring (only visible when closed) --}}
        <span
            x-show="!open"
            class="absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-30 animate-ping"
        ></span>

        {{-- Icon wrapper – rotates and morphs between states --}}
        <span class="relative z-10 flex items-center justify-center w-7 h-7">
            {{-- Chat bubble icon (visible when closed) --}}
            <svg
                x-show="!open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 rotate-90 scale-75"
                x-transition:enter-end="opacity-100 rotate-0 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 rotate-0 scale-100"
                x-transition:leave-end="opacity-0 -rotate-90 scale-75"
                class="w-7 h-7 absolute"
                fill="none" stroke="currentColor" viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>

            {{-- Close (X) icon (visible when open) --}}
            <svg
                x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 rotate-90 scale-75"
                x-transition:enter-end="opacity-100 rotate-0 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 rotate-0 scale-100"
                x-transition:leave-end="opacity-0 rotate-90 scale-75"
                class="w-6 h-6 absolute"
                fill="none" stroke="currentColor" viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </span>
    </button>
</div>

{{-- ============================================================ --}}
{{-- SCRIPT: AI Logic (guarded against duplicate registration)    --}}
{{-- ============================================================ --}}
<script>
    if (typeof window.csirtBotKirim === 'undefined') {

        function csirtEscapeHtml(str) {
            if (typeof str !== 'string') return '';
            return str
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        window.csirtBotKirim = async function(inputElement) {
            const container   = inputElement.closest('[x-data]');
            const messagesArea = container ? container.querySelector('.csirt-bot-messages') : null;
            if (!messagesArea) return;

            const text = inputElement.value.trim();
            if (!text) return;

            // User message bubble
            messagesArea.innerHTML += `
                <div class="flex items-end justify-end mb-4">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-2xl rounded-tr-sm p-3.5 max-w-[85%] shadow-md font-medium text-[13px] leading-relaxed">
                        ${csirtEscapeHtml(text)}
                    </div>
                </div>
            `;
            inputElement.value = '';
            messagesArea.scrollTop = messagesArea.scrollHeight;

            // Typing indicator
            const loadingId = 'csirt-loading-' + Date.now();
            messagesArea.innerHTML += `
                <div id="${loadingId}" class="flex items-start mb-4">
                    <div class="bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 text-gray-500 dark:text-gray-400 rounded-2xl rounded-tl-sm p-3.5 max-w-[85%] shadow-sm font-medium text-[13px] flex items-center gap-3">
                        <span class="flex gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-bounce"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 animate-bounce" style="animation-delay:0.2s"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-bounce" style="animation-delay:0.4s"></span>
                        </span>
                        <span class="animate-pulse">Menyambungkan ke Jaringan AI...</span>
                    </div>
                </div>
            `;
            messagesArea.scrollTop = messagesArea.scrollHeight;

            const csrfToken = (document.querySelector('meta[name="csrf-token"]') || {}).getAttribute?.('content') ?? '';

            try {
                const response = await fetch('/chatbot-reply', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ message: text })
                });

                const data = await response.json();
                const el = document.getElementById(loadingId);
                if (el) el.remove();

                const safeReply = csirtEscapeHtml(data.reply || '').replace(/\n/g, '<br>');
                messagesArea.innerHTML += `
                    <div class="flex items-start mb-4">
                        <div class="bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 text-gray-700 dark:text-gray-200 rounded-2xl rounded-tl-sm p-3.5 max-w-[85%] shadow-sm font-medium text-[13px] leading-relaxed">
                            ${safeReply}
                        </div>
                    </div>
                `;
                messagesArea.scrollTop = messagesArea.scrollHeight;

            } catch (error) {
                const el = document.getElementById(loadingId);
                if (el) el.remove();
                messagesArea.innerHTML += `
                    <div class="flex items-start mb-4">
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 text-red-600 dark:text-red-400 rounded-2xl rounded-tl-sm p-3.5 max-w-[85%] shadow-sm font-medium text-[13px]">
                            <strong class="block mb-1">SYSTEM_ERROR:</strong>
                            Koneksi ke server AI terputus. Silakan periksa jaringan Anda atau coba beberapa saat lagi.
                        </div>
                    </div>
                `;
                messagesArea.scrollTop = messagesArea.scrollHeight;
            }
        };

        window.csirtBotEnter = function(event, inputElement) {
            if (event.key === 'Enter' || event.keyCode === 13) {
                event.preventDefault();
                window.csirtBotKirim(inputElement);
            }
        };

        window.csirtBotClick = function(btnElement) {
            const inputElement = btnElement.previousElementSibling;
            window.csirtBotKirim(inputElement);
        };
    }
</script>
