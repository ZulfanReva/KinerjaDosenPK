<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<x-head></x-head>

<body class="contact-page">

  <!-- Header -->
  <x-header></x-header>

  <main class="main">

    <div class="page-title dark-background" data-aos="fade" id="slideshow-container">
      <div class="container position-relative">
        <h1>Kontak</h1>
        <p>Hubungi kami dimanapun dan kapanpun</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Beranda</a></li>
            <li class="current">Kontak</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->
    
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const images = [
          'assets/foto/cover1.png',
          'assets/foto/cover2.png',
          'assets/foto/cover3.png'
        ];
        let currentIndex = 0;
        const slideshowContainer = document.getElementById('slideshow-container');
        
        // Set the initial background image
        slideshowContainer.style.backgroundImage = `url(${images[currentIndex]})`;
        slideshowContainer.style.transition = 'background-image 1s ease-in-out';
      
        function changeBackgroundImage() {
          currentIndex = (currentIndex + 1) % images.length;
          slideshowContainer.style.backgroundImage = `url(${images[currentIndex]})`;
        }
      
        setInterval(changeBackgroundImage, 5000); // Ganti gambar setiap 5 detik
      });
    </script>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
          <iframe style="border:0; width: 100%; height: 270px;" 
                  src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15754.008485439507!2d114.5892032!3d-3.3217161!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de4211c079cb45d%3A0x3039d80b220e0c0!2sBanjarmasin%2C%20Kota%20Banjarmasin%2C%20Kalimantan%20Selatan!5e0!3m2!1sid!2sid!4v1676961268712!5m2!1sid!2sid" 
                  frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->

        <div class="row gy-4">
          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Alamat</h3>
                <p>Universitas Muhammadiyah Banjarmasin Jl. A. Yani No. 1, Banjarmasin, Kalimantan Selatan 70123</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Telepon</h3>
                <p>+62 8781 2741 357</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email</h3>
                <p>penilaian.dosen@umb.edu</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form id="contact-form" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">
          
                <div class="col-md-6">
                  <input type="text" id="name" class="form-control" placeholder="Nama Anda" required style="border-radius: 4px;">
                </div>
          
                <div class="col-md-6">
                  <div class="position-relative">
                    <select id="category" class="form-control" required style="border-radius: 4px; padding-right: 2.5rem;">
                      <option value="" disabled selected style="color: grey;">Dari Siapa?</option>
                      <option value="Smart Government">Dosen</option>
                      <option value="Smart Government">Tenaga Pendidik</option>
                      <option value="Smart Society">Mahasiswa</option>
                    </select>
                    <i class="fas fa-caret-down position-absolute" style="right: 1rem; top: 50%; transform: translateY(-50%); pointer-events: none;"></i>
                  </div>
                </div>
          
                <div class="col-md-12">
                  <textarea id="message" class="form-control" rows="6" placeholder="Pesan" required style="border-radius: 4px;"></textarea>
                </div>
          
                <div class="col-md-12 text-center">
                  <div class="loading">Tunggu</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Pesan kamu telah terkirim. Terimakasih!</div>
          
                  <button type="submit" id="sendMessageButton">Kirim Pesan</button>
                </div>
          
              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- /Contact Section -->

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const sendMessageButton = document.getElementById('sendMessageButton');
        sendMessageButton.addEventListener('click', function(event) {
          event.preventDefault(); // Mencegah form dari pengiriman default
    
          const name = document.getElementById('name').value.trim();
          const position = document.getElementById('position').value.trim();
          const category = document.getElementById('category').value.trim();
          const message = document.getElementById('message').value.trim();
    
          if (!name || !category || !message) {
            alert('Semua kolom harus diisi sebelum mengirim pesan.');
            return;
          } 
    
          const now = new Date();
          const hours = now.getHours();
          let greeting = "Selamat pagi";
    
          if (hours >= 12 && hours < 18) {
            greeting = "Selamat siang";
          } else if (hours >= 18 || hours < 4) {
            greeting = "Selamat malam";
          }
    
          const whatsappMessage = `${greeting}\n\nNama saya ${name}, salah satu masyarakat dari Desa Digital Banjarmasin, saya ingin mengetahui lebih lanjut tentang layanan ${category}.\n\n${message}\n\nTerima kasih atas perhatiannya`;
    
          const whatsappURL = `https://wa.me/6287812741357?text=${encodeURIComponent(whatsappMessage)}`;
    
          window.open(whatsappURL, '_blank');
        });
      });
    </script>

  </main>

  <!-- Footer-->
  <x-footer></x-footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>