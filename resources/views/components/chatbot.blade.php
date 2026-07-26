<!-- ========================================== -->
<!-- WIDGET CHATBOT KELAS BADAK (POWERED BY AI) -->
<!-- ========================================== -->
<div class="csirt-bot-container fixed bottom-6 right-6 z-[9999]">
    
    <!-- Jendela Chat -->
    <div class="csirt-bot-window hidden w-80 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden mb-4 transition-all duration-300">
        <!-- Header -->
        <div class="bg-blue-700 p-4 flex justify-between items-center text-white">
            <div class="flex items-center space-x-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <h3 class="font-bold text-sm">CSIRT Assistant</h3>
            </div>
            <!-- Tombol Tutup -->
            <button type="button" onclick="this.closest('.csirt-bot-container').querySelector('.csirt-bot-window').classList.add('hidden')" class="hover:text-gray-200 transition-colors cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <!-- Area Pesan -->
        <div class="csirt-bot-messages h-64 p-4 overflow-y-auto bg-gray-50 flex flex-col space-y-3 text-sm">
            <div class="flex items-start">
                <div class="bg-blue-100 text-blue-900 rounded-lg rounded-tl-none p-3 max-w-[85%] shadow-sm font-medium">
                    Halo! Saya asisten AI JatimProv-CSIRT. Ada yang bisa saya bantu terkait pelaporan insiden siber?
                </div>
            </div>
        </div>
        
        <!-- Area Input -->
        <div class="p-3 border-t border-gray-200 bg-white flex">
            <input type="text" autocomplete="off" onkeydown="csirtBotEnter(event, this)" class="flex-1 border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-700 text-sm" placeholder="Ketik pesan Anda...">
            
            <button type="button" onclick="csirtBotClick(this)" class="bg-blue-700 hover:bg-blue-800 text-white px-3 py-2 rounded-r-md transition-colors cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </div>
    </div>
    
    <!-- Tombol Buka -->
    <button type="button" onclick="this.closest('.csirt-bot-container').querySelector('.csirt-bot-window').classList.toggle('hidden')" class="w-14 h-14 bg-blue-700 hover:bg-blue-800 text-white rounded-full shadow-2xl flex items-center justify-center ml-auto transition-transform hover:scale-110 relative cursor-pointer pointer-events-auto">
        <span class="absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-40 animate-ping"></span>
        <svg class="w-7 h-7 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
    </button>
</div>

<script>
    if (typeof window.csirtBotKirim === 'undefined') {
        
        // Ubah menjadi async function agar bisa menggunakan await fetch
        window.csirtBotKirim = async function(inputElement) {
            const container = inputElement.closest('.csirt-bot-container');
            const messagesArea = container.querySelector('.csirt-bot-messages');
            const text = inputElement.value.trim();
            
            if (!text) return;

            // 1. Memunculkan Chat User
            messagesArea.innerHTML += `<div class="flex items-end justify-end"><div class="bg-blue-700 text-white rounded-lg rounded-tr-none p-3 max-w-[85%] shadow-sm font-medium mb-3">${text}</div></div>`;
            inputElement.value = '';
            messagesArea.scrollTop = messagesArea.scrollHeight;

            // 2. Memunculkan Indikator Loading (Animasi Mengetik)
            const loadingId = 'loading-' + Date.now();
            messagesArea.innerHTML += `<div id="${loadingId}" class="flex items-start"><div class="bg-gray-200 text-gray-600 rounded-lg rounded-tl-none p-3 max-w-[85%] shadow-sm font-medium mb-3 animate-pulse">AI sedang mengetik...</div></div>`;
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

                // Tampilkan balasan asli dari AI
                messagesArea.innerHTML += `<div class="flex items-start"><div class="bg-blue-100 text-blue-900 rounded-lg rounded-tl-none p-3 max-w-[85%] shadow-sm font-medium mb-3">${data.reply}</div></div>`;
                messagesArea.scrollTop = messagesArea.scrollHeight;

            } catch (error) {
                // Hapus indikator loading jika error
                let loadEl = document.getElementById(loadingId);
                if (loadEl) loadEl.remove();

                // Tampilkan pesan error
                messagesArea.innerHTML += `<div class="flex items-start"><div class="bg-red-100 text-red-800 rounded-lg rounded-tl-none p-3 max-w-[85%] shadow-sm font-medium mb-3">Waduh, koneksi ke server AI terputus nih. Coba lagi ya!</div></div>`;
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