<!-- Sertakan JavaScript (opsional) -->
<script src="{{ asset('js/theme-toggle.js') }}"></script>

<!-- Sertakan CSS (opsional) -->
<link href="{{ asset('css/dark-mode.css') }}" rel="stylesheet">


<script>
    // Mendapatkan tombol dan body untuk perubahan tema
    const modeToggleButton = document.getElementById('modeToggle');
    const body = document.body;

    // Mengecek apakah mode gelap sudah dipilih sebelumnya di localStorage
    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode'); // Aktifkan mode gelap
        modeToggleButton.textContent = 'Mode Terang'; // Ubah teks tombol
    }

    // Fungsi untuk mengganti mode malam
    modeToggleButton.addEventListener('click', () => {
        body.classList.toggle('dark-mode'); // Toggle mode gelap
        if (body.classList.contains('dark-mode')) {
            modeToggleButton.textContent = 'Mode Terang'; // Ubah teks tombol saat mode malam aktif
            localStorage.setItem('theme', 'dark'); // Simpan preferensi mode malam
        } else {
            modeToggleButton.textContent = 'Mode Malam'; // Ubah teks tombol saat mode malam dinonaktifkan
            localStorage.removeItem('theme'); // Hapus preferensi mode malam
        }
    });
</script>


<style>
    /* Mode Gelap */
    .dark-mode {
        background-color: #121212; /* Background gelap */
        color: white; /* Teks terang */
    }

    .dark-mode .card-background {
        background: rgba(0, 0, 0, 0.5); /* Card gelap */
    }

    .dark-mode .btn {
        background-color: #333; /* Tombol mode malam */
        color: white;
    }

    .dark-mode .bg-gradient-info {
        background: linear-gradient(135deg, #6a1b9a, #f44336); /* Ubah gradient jika perlu */
    }
</style>
