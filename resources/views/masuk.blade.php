<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<x-head></x-head>

<body>
    <div class="background-container">
        <img src="assets/foto/cover1.png" alt="Background Image 1" class="hero-bg" id="backgroundImage1">
        <img src="assets/foto/cover1.png" alt="Background Image 2" class="hero-bg" id="backgroundImage2">
    </div>

    <!-- Form Login -->
    <div class="wrapper">
        <img src="assets/foto/logo.png" alt="Your Company Logo" class="LogoLogin"
            style="max-width: 100px; max-height: 150px; width: auto; height: auto; display: block; margin: 0 auto;">
        <h1 style="color: white">E-KINERJA UMBJM</h1>
        <form action="{{ route('masuk') }}" method="POST">
            @csrf
            <div class="input-box">
                <input type="text" name="username" placeholder="Nama Pengguna" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Kata sandi" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label></label>
                <a href="#" id="forgot-password-link">Lupa Password</a>
            </div>
            <button type="submit" class="btn">Masuk</button>
        </form>
    </div>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Masuk Gagal',
                html: `{!! session('error') !!}`, // Menggunakan '!!' untuk menampilkan HTML
                customClass: {
                    confirmButton: 'btn-custom' // Menambahkan kelas kustom untuk tombol
                }
            });
        @endif
    </script>

    <style>
        /* Mengubah ukuran teks SweetAlert */
        .swal2-popup .swal2-html-container {
            font-size: 15px;
            /* Ukuran teks untuk pesan */
        }

        /* Mengubah warna tombol konfirmasi SweetAlert */
        .swal2-popup .btn-custom {
            background-color: #001973;
            /* Warna tombol */
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            /* Sudut tombol lebih bulat */
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = [
                'assets/foto/cover1.png',
                'assets/foto/cover2.png',
                'assets/foto/cover3.png',
                'assets/foto/cover4.png',
                'assets/foto/cover5.png',
                'assets/foto/cover6.png'
            ];
            const imageElement1 = document.getElementById('backgroundImage1');
            const imageElement2 = document.getElementById('backgroundImage2');
            let currentIndex = 0;
            let showingElement = 1;
            const transitionDuration = 1000; // Durasi transisi dalam milidetik
            const changeInterval = 10000; // Interval pergantian gambar dalam milidetik

            // Preload images to avoid lag during transitions
            const preloadImages = () => {
                images.forEach(src => {
                    const img = new Image();
                    img.src = src;
                });
            };

            preloadImages();

            function changeImage() {
                const incomingImageElement = showingElement === 1 ? imageElement2 : imageElement1;
                const outgoingImageElement = showingElement === 1 ? imageElement1 : imageElement2;

                // Set the new image source
                incomingImageElement.src = images[currentIndex];

                // Start with the new image visible
                incomingImageElement.classList.remove('fade-out');
                outgoingImageElement.classList.add('fade-out');

                // Toggle the elements
                showingElement = showingElement === 1 ? 2 : 1;

                currentIndex = (currentIndex + 1) % images.length;
            }

            // Set the interval to be the same as the transition duration plus some buffer
            setInterval(changeImage, changeInterval);

            // Start the initial transition
            setTimeout(changeImage, transitionDuration);

            // Menangani klik pada tautan "Lupa Password"
            const forgotPasswordLink = document.getElementById('forgot-password-link');

            forgotPasswordLink.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah aksi default tautan

                // Menampilkan alert
                if (confirm(
                        "Silakan hubungi admin untuk mengatur ulang kata sandi. Klik OK untuk melanjutkan ke WhatsApp."
                        )) {
                    // Mengarahkan pengguna ke WhatsApp
                    window.location.href = "https://wa.me/+6287812741357";
                }
            });
        });
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .background-container {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }

        .hero-bg.fade-out {
            opacity: 0;
        }

        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(9px);
            color: #fff;
            border-radius: 12px;
            padding: 30px 40px;
            position: relative;
            /* Ensure the form stays above the background images */
            z-index: 1;
            /* Make sure the form is above the background images */
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
        }

        .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 0 45px 0 20px;
        }

        .input-box input::placeholder {
            color: #fff;
        }

        .input-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .remember-forgot label input {
            accent-color: #fff;
            margin-right: 3px;
        }

        .remember-forgot a {
            color: #fff;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;
        }

        .register-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover {
            text-decoration: underline;
        }
    </style>
</body>

</html>
