{{--
    Komponen: <x-floating-chat />
    Tombol logo melayang di pojok layar, saat ditekan membuka panel chat
    bergaya ChatGPT. Pesan & balasan masih memakai data dummy (JS murni),
    belum tersambung ke controller/route Laravel.

    Cara pakai: taruh <x-floating-chat /> di layout utama (mis. sebelum
    penutup </body> pada layout yang dipakai bersama, atau di setiap
    halaman seperti pemanggilan <x-sidebar_siakad />).
--}}

<link rel="stylesheet" href="{{ asset('/css/component/chatbot.css') }}">

<!-- TOMBOL LOGO MELAYANG -->
<button type="button" class="chat-fab" id="chatFabToggle" title="Butuh bantuan?">
    <i class="fa-solid fa-comment-dots chat-fab-icon-open"></i>
    <i class="fa-solid fa-xmark chat-fab-icon-close"></i>
</button>

<!-- PANEL CHAT -->
<div class="chat-panel" id="chatPanel">

    <div class="chat-panel-header">
        <div class="chat-panel-brand">
            <div class="chat-panel-avatar">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div class="chat-panel-title">
                <h4>Asisten SIAKAD</h4>
                <span class="chat-panel-status"><i class="fa-solid fa-circle"></i> Online</span>
            </div>
        </div>
        <button type="button" class="chat-panel-close" id="chatPanelClose" title="Tutup">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="chat-panel-body" id="chatPanelBody">
        <div class="chat-bubble chat-bubble-bot">
            <div class="chat-bubble-avatar"><i class="fa-solid fa-graduation-cap"></i></div>
            <div class="chat-bubble-content">
                Assalamu'alaikum! 👋 Saya Asisten SIAKAD. Ada yang bisa saya bantu seputar sekolah, pembayaran, atau pengumuman?
            </div>
        </div>
    </div>

    <div class="chat-panel-typing" id="chatTypingIndicator">
        <div class="chat-bubble-avatar"><i class="fa-solid fa-graduation-cap"></i></div>
        <div class="chat-typing-dots">
            <span></span><span></span><span></span>
        </div>
    </div>

    <form class="chat-panel-input" id="chatForm" autocomplete="off">
        <input
            type="text"
            id="chatInput"
            placeholder="Tulis pesan Anda..."
            maxlength="300"
        >
        <button type="submit" class="chat-send-btn" title="Kirim">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </form>

</div>

<script>
(function () {
    const fab = document.getElementById('chatFabToggle');
    const panel = document.getElementById('chatPanel');
    const closeBtn = document.getElementById('chatPanelClose');
    const body = document.getElementById('chatPanelBody');
    const form = document.getElementById('chatForm');
    const input = document.getElementById('chatInput');
    const typingIndicator = document.getElementById('chatTypingIndicator');

    // Balasan dummy — nanti tinggal diganti pemanggilan ke backend/AI sungguhan
    const balasanDummy = [
        "Terima kasih atas pesannya. Tim kami akan segera menindaklanjuti pertanyaan Anda.",
        "Baik, saya catat pertanyaannya. Untuk info lebih lengkap silakan cek menu terkait di sidebar ya.",
        "Pertanyaan yang bagus! Saat ini saya masih dalam tahap pengembangan, jadi jawaban ini masih contoh dummy.",
        "Untuk hal ini, sebaiknya konfirmasi langsung ke pihak tata usaha sekolah agar informasinya lebih akurat.",
        "Sudah saya terima pesannya. Ada lagi yang ingin ditanyakan?",
    ];

    function bukaPanel() {
        panel.classList.add('active');
        fab.classList.add('active');
        input.focus();
        scrollKeBawah();
    }

    function tutupPanel() {
        panel.classList.remove('active');
        fab.classList.remove('active');
    }

    function scrollKeBawah() {
        body.scrollTop = body.scrollHeight;
    }

    function tambahBubble(teks, pengirim) {
        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble chat-bubble-' + pengirim;

        if (pengirim === 'bot') {
            bubble.innerHTML = `
                <div class="chat-bubble-avatar"><i class="fa-solid fa-graduation-cap"></i></div>
                <div class="chat-bubble-content"></div>
            `;
            bubble.querySelector('.chat-bubble-content').textContent = teks;
        } else {
            bubble.innerHTML = `<div class="chat-bubble-content"></div>`;
            bubble.querySelector('.chat-bubble-content').textContent = teks;
        }

        body.appendChild(bubble);
        scrollKeBawah();
    }

    function kirimPesan(e) {
        e.preventDefault();
        const teks = input.value.trim();
        if (!teks) return;

        tambahBubble(teks, 'user');
        input.value = '';

        // Tampilkan indikator "sedang mengetik"
        typingIndicator.classList.add('active');
        scrollKeBawah();

        const waktuTunggu = 700 + Math.random() * 700;
        setTimeout(() => {
            typingIndicator.classList.remove('active');
            const balasan = balasanDummy[Math.floor(Math.random() * balasanDummy.length)];
            tambahBubble(balasan, 'bot');
        }, waktuTunggu);
    }

    fab.addEventListener('click', () => {
        panel.classList.contains('active') ? tutupPanel() : bukaPanel();
    });

    closeBtn.addEventListener('click', tutupPanel);
    form.addEventListener('submit', kirimPesan);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') tutupPanel();
    });
})();
</script>