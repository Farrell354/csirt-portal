<!-- ========================================== -->
<!-- WIDGET CHATBOT KELAS BADAK (POWERED BY AI) -->
<!-- ========================================== -->

<style>
    /* Kustomisasi Scrollbar Jendela Chat Biar Sleek */
    .csirt-scroll::-webkit-scrollbar { width: 5px; }
    .csirt-scroll::-webkit-scrollbar-track { background: transparent; }
    .csirt-scroll::-webkit-scrollbar-thumb { background: #3b82f6; border-radius: 10px; }
    .dark .csirt-scroll::-webkit-scrollbar-thumb { background: #1e3a8a; }
</style>

<div class="csirt-bot-container fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-[9999] flex flex-col items-end">
    
    <!-- Jendela Chat -->
    <div class="csirt-bot-window hidden flex-col w-[calc(100vw-2rem)] sm:w-96 h-[calc(100vh-6rem)] max-h-[32rem] bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl rounded-2xl shadow-2xl dark:shadow-[0_0_40px_rgba(0,0,0,0.5)] border border-gray-200/50 dark:border-slate-700/50 overflow-hidden mb-4 transition-all duration-300 origin-bottom-right">
        
        <!-- Header (Secure Terminal Style) -->
        <div class="shrink-0 bg-gradient-to-r from-blue-700 to-cyan-600 p-4 flex justify-between items-center text-white relative overflow-hidden">
            <!-- Glow Ambient -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            
            <div class="flex items-center space-x-3 relative z-10">
                <div class="relative">
                    <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
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
            <!-- Tombol Tutup -->
            <button type="button" onclick="const win = this.closest('.csirt-bot-container').querySelector('.csirt-bot-window'); win.classList.add('hidden'); win.classList.remove('flex');" class="relative z-10 p-1.5 bg-black/10 hover:bg-black/20 rounded-md transition-colors cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <!-- Area Pesan -->
        <div class="csirt-bot-messages csirt-scroll flex-1 p-5 overflow-y-auto bg-gray-50/50 dark:bg-slate-950/50 flex flex-col text-sm">
            <!-- Balon Pesan Awal AI -->
            <div class="flex items-start mb-4">
                <div class="bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 text-gray-700 dark:text-gray-200 rounded-2xl rounded-tl-sm p-3.5 max-w-[85%] shadow-sm font-medium text-[13px] leading-relaxed">
                    Halo! Saya asisten AI JatimProv-CSIRT. Ada yang bisa saya bantu terkait informasi layanan atau pelaporan insiden siber?
                </div>
            </div>
        </div>
        
        <!-- Area Input -->
        <div class="shrink-0 p-3 border-t border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 flex gap-2 items-center">
            <input type="text" autocomplete="off" onkeydown="csirtBotEnter(event, this)" class="flex-1 bg-gray-100 dark:bg-slate-800 border-transparent focus:border-blue-500 focus:bg-white dark:focus:bg-slate-900 focus:ring-2 focus:ring-blue-500/50 rounded-xl px-4 py-2.5 text-sm text-gray-900 dark:text-white transition-all placeholder-gray-400 dark:placeholder-gray-500 outline-none" placeholder="Ketik pesan Anda...">
            
            <button type="button" onclick="csirtBotClick(this)" class="bg-blue-600 hover:bg-cyan-500 text-white p-2.5 rounded-xl transition-all shadow-md hover:shadow-cyan-500/30 hover:-translate-y-0.5 cursor-pointer flex shrink-0">
                <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </div>
    </div>
    
    <!-- Tombol Buka Chatbot -->
    <button type="button" onclick="const win = this.closest('.csirt-bot-container').querySelector('.csirt-bot-window'); win.classList.toggle('hidden'); win.classList.toggle('flex');" class="w-14 h-14 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white rounded-full shadow-[0_0_20px_rgba(59,130,246,0.5)] flex items-center justify-center transition-transform hover:scale-110 relative group cursor-pointer pointer-events-auto border-2 border-white/10 mt-4">
        <!-- Ping Effect Bawaan -->
        <span class="absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-40 animate-ping"></span>
        <svg class="w-7 h-7 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
    </button>
</div>

<!-- ========================================== -->
<!-- SCRIPT LOGIK AI (Dengan Suntikan Desain Baru) -->
<!-- ========================================== -->
<script>
    if (typeof window.csirtBotKirim === 'undefined') {
        
        window.csirtBotKirim = async function(inputElement) {
            const container = inputElement.closest('.csirt-bot-container');
            const messagesArea = container.querySelector('.csirt-bot-messages');
            const text = inputElement.value.trim();
            
            if (!text) return;

            // 1. Memunculkan Chat User (Desain Premium)
            messagesArea.innerHTML += `
                <div class="flex items-end justify-end mb-4">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-2xl rounded-tr-sm p-3.5 max-w-[85%] shadow-md font-medium text-[13px] leading-relaxed">
                        ${text}
                    </div>
                </div>
            `;
            inputElement.value = '';
            messagesArea.scrollTop = messagesArea.scrollHeight;

            // 2. Memunculkan Indikator Loading / Typing Animasi (Keren)
            const loadingId = 'loading-' + Date.now();
            messagesArea.innerHTML += `
                <div id="${loadingId}" class="flex items-start mb-4">
                    <div class="bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 text-gray-500 dark:text-gray-400 rounded-2xl rounded-tl-sm p-3.5 max-w-[85%] shadow-sm font-medium text-[13px] flex items-center gap-3">
                        <span class="flex gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-bounce"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 animate-bounce" style="animation-delay: 0.2s"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-bounce" style="animation-delay: 0.4s"></span>
                        </span>
                        <span class="animate-pulse">Menyambungkan ke Jaringan AI...</span>
                    </div>
                </div>
            `;
            messagesArea.scrollTop = messagesArea.scrollHeight;

            // 3. Ambil CSRF Token
            let csrfMeta = document.querySelector('meta[name="csrf-token"]');
            let csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

            // 4. Hubungkan ke Backend (Groq AI)
            try {
                let response = await fetch('/chatbot-reply', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ message: text })
                });

                let data = await response.json();

                // Hapus indikator loading
                document.getElementById(loadingId).remove();

                // Tampilkan balasan asli dari AI (Desain Premium)
                messagesArea.innerHTML += `
                    <div class="flex items-start mb-4">
                        <div class="bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 text-gray-700 dark:text-gray-200 rounded-2xl rounded-tl-sm p-3.5 max-w-[85%] shadow-sm font-medium text-[13px] leading-relaxed">
                            ${data.reply}
                        </div>
                    </div>
                `;
                messagesArea.scrollTop = messagesArea.scrollHeight;

            } catch (error) {
                // Hapus indikator loading jika error
                let loadEl = document.getElementById(loadingId);
                if (loadEl) loadEl.remove();

                // Tampilkan pesan error (Desain Premium)
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