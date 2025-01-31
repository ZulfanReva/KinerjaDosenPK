<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<x-head></x-head>

<body class="index-page">

    <!-- Navbar  -->
    <x-navbar></x-navbar>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="assets/foto/cover1.png" alt="" class="hero-bg" id="backgroundImage1">
            <img src="assets/foto/cover1.png" alt="" class="hero-bg" id="backgroundImage2">

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const images = [
                        'assets/foto/cover1.png',
                        'assets/foto/cover2.png',
                        'assets/foto/cover3.png',
                        'assets/foto/cover4.png',
                        'assets/foto/cover5.png'
                    ];
                    const imageElement1 = document.getElementById('backgroundImage1');
                    const imageElement2 = document.getElementById('backgroundImage2');
                    let currentIndex = 0;
                    let showingElement = 1;
                    const transitionDuration = 1000; // Durasi transisi dalam milidetik
                    const changeInterval = 8000; // Interval pergantian gambar dalam milidetik

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
                });
            </script>

            <div class="container">
                <div class="row gy-4 d-flex justify-content-between">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">

                        <h2 class="wave">
                            <span class="line">Selamat Datang</span>
                            <span class="line">Di Sistem Penilaian Kinerja Dosen</span>
                        </h2>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const waveLines = document.querySelectorAll('.wave .line'); // Pilih semua elemen dengan kelas line

                                waveLines.forEach(line => {
                                    const text = line.textContent;
                                    line.textContent = '';

                                    text.split('').forEach((char, index) => {
                                        const span = document.createElement('span');
                                        if (char === ' ') {
                                            span.innerHTML = '&nbsp;'; // Preserve spaces
                                        } else {
                                            span.textContent = char;
                                        }
                                        span.style.transitionDelay = `${index * 0.1}s`;
                                        line.appendChild(span);
                                    });
                                });

                                function startWaveAnimation() {
                                    waveLines.forEach(line => {
                                        const spans = line.querySelectorAll('span');
                                        spans.forEach((span, index) => {
                                            // Ensure that the span has a transition applied
                                            span.style.transition = 'transform 2s, opacity 2s';

                                            // Move to the left and fade out
                                            setTimeout(() => {
                                                span.style.opacity = '0';
                                                span.style.transform = 'translateX(-20px)';
                                            }, index * 100);

                                            // Reset the position and opacity after animation
                                            setTimeout(() => {
                                                span.style.opacity = '1';
                                                span.style.transform = 'translateX(0)';
                                            }, 2000 + index * 100);
                                        });
                                    });
                                }

                                // Start the animation initially and then repeat every 10 seconds
                                startWaveAnimation(); // Start the animation immediately
                                setInterval(startWaveAnimation, 10000); // Repeat every 10 seconds
                            });
                        </script>


                        <h6 data-aos="fade-up" data-aos-delay="100"
                            style="text-align: justify; font-size: 0.85em; line-height: 1.4; margin: 0; padding: 0;">
                            Pantau dan Evaluasi Kinerja Dosen dengan Mudah dan Terintegrasi.
                        </h6>

                        <div class="row gy-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="col-lg-3 col-6">
                                <div class="stats-item text-center w-100 h-100">
                                    <span id="counter2" data-purecounter-start="0" data-purecounter-end="150"
                                        data-purecounter-duration="3" class="purecounter">0</span>
                                    <p>Dosen Aktif</p>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="stats-item text-center w-100 h-100">
                                    <span id="counter2" data-purecounter-start="0" data-purecounter-end="17"
                                        data-purecounter-duration="3" class="purecounter">0</span>
                                    <p>Dosen Tugas</p>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="stats-item text-center w-100 h-100">
                                    <span id="counter3" data-purecounter-start="0" data-purecounter-end="6"
                                        data-purecounter-duration="3" class="purecounter">0</span>
                                    <p>Fakultas</p>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="stats-item text-center w-100 h-100">
                                    <span id="counter4" data-purecounter-start="0" data-purecounter-end="20"
                                        data-purecounter-duration="3" class="purecounter">0</span>
                                    <p>Prodi</p>
                                </div>
                            </div>
                        </div>

                        <style>
                            .stats-item {
                                display: flex;
                                flex-direction: column;
                                justify-content: center;
                                align-items: center;
                                padding: 10px;
                                /* Tambahkan padding jika diperlukan */
                            }

                            .single-line {
                                white-space: nowrap;
                                /* Prevent text from wrapping */
                                overflow: hidden;
                                /* Hide any overflowing text */
                                text-overflow: clip;
                                /* Ensure text doesn't add ellipsis */
                                font-size: 1rem;
                                /* Adjust font size if needed */
                            }
                        </style>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const counters = document.querySelectorAll('.purecounter');

                                counters.forEach(counter => {
                                    const start = parseFloat(counter.getAttribute('data-purecounter-start'));
                                    const end = parseFloat(counter.getAttribute('data-purecounter-end'));
                                    const duration = parseFloat(counter.getAttribute('data-purecounter-duration')) *
                                    1000; // Duration in milliseconds
                                    const startTime = performance.now();

                                    const step = (timestamp) => {
                                        const elapsed = timestamp - startTime;
                                        const progress = Math.min(elapsed / duration, 1);
                                        const currentValue = start + (end - start) * progress;

                                        // Apply decimal formatting for specific counter
                                        if (counter.id === 'counter1') {
                                            counter.innerText = currentValue.toFixed(2);
                                        } else {
                                            counter.innerText = Math.round(currentValue);
                                        }

                                        if (progress < 1) {
                                            requestAnimationFrame(step); // Continue animation
                                        } else {
                                            // Ensure final value is correctly formatted
                                            if (counter.id === 'counter1') {
                                                counter.innerText = end.toFixed(2);
                                            } else {
                                                counter.innerText = Math.round(end);
                                            }
                                        }
                                    };

                                    requestAnimationFrame(step);
                                });
                            });
                        </script>

                    </div>


                    <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                        <img src="assets/foto/penilaian.png" class="img-fluid mb-3 mb-lg-0 animated-img" alt="">
                    </div>

                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Tentang Section -->
        <section id="tentangsistem" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>TENTANG SISTEM<br></span>
                <h2>TENTANG SISTEM</h2>
                <p>Kenali lebih dekat tujuan dan manfaat Sistem Penilaian Kinerja Dosen.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="card">
                            <div class="card-img">
                                <img src="assets/foto/sejarah.png" alt="" class="img-fluid">
                            </div>
                            <h3><a class="stretched-link">Latar Belakang</a></h3>
                            <p style="text-align: justify;">
                                Sistem ini dikembangkan untuk meningkatkan efisiensi dan transparansi dalam evaluasi
                                kinerja dosen di Universitas Muhammadiyah Banjarmasin. Sistem ini, penilaian kinerja
                                dosen hanya berfokus pada aspek Perilaku Kerja (PK) seperti yang tercantum pada pedoman
                                penilaian kinerja dosen di UMBJM.
                            </p>
                        </div>
                    </div><!-- End Card Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="card">
                            <div class="card-img">
                                <img src="assets/foto/visimisi.png" alt="" class="img-fluid">
                            </div>
                            <h3><a class="stretched-link">Visi & Misi</a></h3>
                            <p style="text-align: justify;">
                                <strong>Visi</strong><br>
                                Meningkatkan kualitas akademik melalui evaluasi kinerja dosen yang akurat dan berbasis
                                data.<br><br>
                                <strong>Misi</strong><br>
                                • Menyediakan sistem digital yang mempermudah proses evaluasi kinerja.<br>
                                • Mendukung dosen dalam pengembangan karir dengan penilaian yang transparan.<br>
                                • Membantu bagian Sumber Daya Insani dalam pengelolaan dan pengambilan keputusan
                                strategis.
                            </p>
                        </div>
                    </div><!-- End Card Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="card">
                            <div class="card-img">
                                <img src="assets/foto/manfaat.png" alt="" class="img-fluid">
                            </div>
                            <h3><a class="stretched-link">Manfaat Sistem</a></h3>
                            <p style="text-align: justify;">
                                Sistem Penilaian Kinerja Dosen diharapkan memberikan manfaat berikut:<br><br>
                                • Menyediakan sistem digital yang mempermudah proses evaluasi kinerja.<br>
                                • Mendukung dosen dalam pengembangan karir dengan penilaian yang transparan.<br>
                                • Membantu bagian Sumber Daya Insani dalam pengelolaan dan pengambilan keputusan
                                strategis.
                            </p>
                        </div>
                    </div><!-- End Card Item -->

                </div>

            </div>

        </section><!-- /Tentang Section -->

        <!-- Penilaian Section -->
        <section id="penilaian" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Penilaian Dosen</span>
                <h2>Penilaian Dosen</h2>
                <p>Berikut adalah <strong>aspek-aspek penilaian</strong> yang digunakan dalam Sistem Penilaian Kinerja
                    Dosen Universitas Muhammadiyah Banjarmasin.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4 justify-content-center">

                    <!-- Perilaku Kerja -->
                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <img src="assets/foto/pk.png" alt="Perilaku Kerja">
                            <h4><a class="stretched-link">Perilaku Kerja (PK)</a></h4>
                            <p>Evaluasi terhadap sikap dan etika kerja, termasuk kolaborasi, tanggung jawab, dan
                                kepimpinan yang sudah ditetapkan oleh bagian Sumber Daya Insani (SDI).</p>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>


        </section><!-- /Penilaian Section -->

        <!-- Struktur Organisasi Section -->
        <section id="strukturorganisasi" class="departments section team section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Struktur Organisasi</span>
                <h2>Struktur Organisasi</h2>
                <p>Berikut adalah <strong>struktur organisasi</strong> yang bertanggung jawab dalam pengelolaan Sistem
                    Penilaian Kinerja Dosen Universitas Muhammadiyah Banjarmasin.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-lg-3">
                        <ul class="nav nav-tabs flex-column">
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab"
                                    href="#departments-tab-1">Rektor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-2">Wakil Rektor
                                    II</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-3">Biro Administrasi
                                    Umum dan Keuangan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-4">Sumber Daya
                                    Insani</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-9 mt-4 mt-lg-0">
                        <div class="tab-content">

                            <!-- Rektor -->
                            <div class="tab-pane active show" id="departments-tab-1">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Rektor</h3>
                                        <p class="fst-italic">Prof. Dr. H. Khudzaifah Dimyati, SH., M.Hum.</p>
                                        <p>Rektor Universitas Muhammadiyah Banjarmasin bertanggung jawab secara
                                            keseluruhan terhadap implementasi dan keberhasilan Sistem Penilaian Kinerja
                                            Dosen sebagai bagian dari upaya meningkatkan kualitas pendidikan dan
                                            manajemen sumber daya manusia.</p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2" data-aos="fade-up"
                                        data-aos-delay="400">
                                        <div class="team-member">
                                            <div class="member-img">
                                                <img src="assets/foto/struktur1.png" class="img-fluid"
                                                    alt="">
                                                <div class="social">
                                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                                    <a href=""><i class="bi bi-facebook"></i></a>
                                                    <a href=""><i class="bi bi-instagram"></i></a>
                                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                                    <a href=""><i class="bi bi-whatsapp"></i></a>
                                                </div>
                                            </div>
                                            <div class="member-info">
                                                <h4>Khudzaifah Dimyati</h4>
                                                <span>Rektor</span>
                                            </div>
                                        </div>
                                    </div><!-- End Team Member -->
                                </div>
                            </div><!-- End Rektor -->

                            <!-- Wakil Rektor II -->
                            <div class="tab-pane" id="departments-tab-2">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Wakil Rektor II</h3>
                                        <p class="fst-italic">Yustan Azidin, Ns., M.Kep.</p>
                                        <p>Wakil Rektor II berperan sebagai koordinator dalam pengawasan dan pengelolaan
                                            sistem ini, memastikan semua proses berjalan sesuai standar institusi dan
                                            mendukung visi universitas.</p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2" data-aos="fade-up"
                                        data-aos-delay="400">
                                        <div class="team-member">
                                            <div class="member-img">
                                                <img src="assets/foto/struktur4.png" class="img-fluid"
                                                    alt="">
                                                <div class="social">
                                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                                    <a href=""><i class="bi bi-facebook"></i></a>
                                                    <a href=""><i class="bi bi-instagram"></i></a>
                                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                                    <a href=""><i class="bi bi-whatsapp"></i></a>
                                                </div>
                                            </div>
                                            <div class="member-info">
                                                <h4>Yustan Azidin</h4>
                                                <span>Wakil Rektor II</span>
                                            </div>
                                        </div>
                                    </div><!-- End Team Member -->
                                </div>
                            </div><!-- End Wakil Rektor II -->

                            <!-- BAUK -->
                            <div class="tab-pane" id="departments-tab-3">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Biro Administrasi Umum dan Keuangan (BAUK)</h3>
                                        <p class="fst-italic">Nikmah, S.Sos</p>
                                        <p>BAUK mendukung proses administratif dalam implementasi Sistem Penilaian
                                            Kinerja Dosen, termasuk pengelolaan data dan keuangan yang relevan dengan
                                            evaluasi kinerja dosen.</p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2" data-aos="fade-up"
                                        data-aos-delay="400">
                                        <div class="team-member">
                                            <div class="member-img">
                                                <img src="assets/foto/struktur2.png" class="img-fluid"
                                                    alt="">
                                                <div class="social">
                                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                                    <a href=""><i class="bi bi-facebook"></i></a>
                                                    <a href=""><i class="bi bi-instagram"></i></a>
                                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                                    <a href=""><i class="bi bi-whatsapp"></i></a>
                                                </div>
                                            </div>
                                            <div class="member-info">
                                                <h4>Nikmah, S.Sos</h4>
                                                <span>Kepala BAUK</span>
                                            </div>
                                        </div>
                                    </div><!-- End Team Member -->
                                </div>
                            </div><!-- End BAUK -->

                            <!-- Sumber Daya Insani -->
                            <div class="tab-pane" id="departments-tab-4">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Sumber Daya Insani (SDI)</h3>
                                        <p class="fst-italic">Wahyu</p>
                                        <p>Bagian SDI bertanggung jawab langsung dalam pengelolaan dan pelaksanaan
                                            Sistem Penilaian Kinerja Dosen, memastikan proses penilaian berjalan
                                            transparan dan berbasis data yang valid.</p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2" data-aos="fade-up"
                                        data-aos-delay="400">
                                        <div class="team-member">
                                            <div class="member-img">
                                                <img src="assets/foto/struktur6.png" class="img-fluid"
                                                    alt="">
                                                <div class="social">
                                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                                    <a href=""><i class="bi bi-facebook"></i></a>
                                                    <a href=""><i class="bi bi-instagram"></i></a>
                                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                                    <a href=""><i class="bi bi-whatsapp"></i></a>
                                                </div>
                                            </div>
                                            <div class="member-info">
                                                <h4>Wahyu</h4>
                                                <span>Kepala SDI</span>
                                            </div>
                                        </div>
                                    </div><!-- End Team Member -->
                                </div>
                            </div><!-- End SDI -->

                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Struktur Organisasi Section -->

        <!-- Lokasi dan Peta Section -->
        <section id="lokasidanpeta" class="lokasidanpeta section dark-background">

            <div class="background-image">
                <img src="assets/foto/lokasidanpeta.png" alt="">
            </div>

            <div class="container">
                <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                    <div class="col-xl-10">
                        <div class="text-center">
                            <h3>Lokasi dan Peta</h3>
                            <p>Peta interaktif Kampus Universitas Muhammadiyah Banjarmasin</p>
                            <a class="cta-btn" href="https://maps.app.goo.gl/d5RcJqiBJBpikk4R9"
                                target="_blank">Informasi Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>


        <!-- Sponsorship Section -->
        <section id="sponsorship" class="sponsorship section">

            <div class="section-title" data-aos="fade-up">
                <span>Didukung Oleh</span>
                <h2>Didukung Oleh</h2>
                <p>Kami berterima kasih kepada semua pihak yang telah mendukung pengembangan Sistem Penilaian Kinerja
                    Dosen</p>
            </div><!-- End Section Title -->

            <div class="logos">
                <div class="logos-slide">
                    <img src="assets/foto/umbjm.png" alt="Sponsor 1" />
                    <img src="assets/foto/ftumbjm.png" alt="Sponsor 2" />
                    <img src="assets/foto/pemkalteng.png" alt="Sponsor 3" />
                    <img src="assets/foto/pemprov.png" alt="Sponsor 4" />
                    <img src="assets/foto/pemkot.png" alt="Sponsor 5" />
                    <img src="assets/foto/kemenkeu.png" alt="Sponsor 6" />
                    <img src="assets/foto/kominfo.png" alt="Sponsor 7" />
                    <img src="assets/foto/kemenparekraf.png" alt="Sponsor 8" />
                    <img src="assets/foto/wonderful.png" alt="Sponsor 9" />
                    <img src="assets/foto/telkom.png" alt="Sponsor 10" />
                </div>

                <script>
                    var copy = document.querySelector(".logos-slide").cloneNode(true);
                    document.querySelector(".logos").appendChild(copy);
                </script>

            </div>

            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }

                body {
                    background: #f2f2f2;
                }

                @keyframes slide {
                    from {
                        transform: translateX(0);
                    }

                    to {
                        transform: translateX(-100%);
                    }
                }

                .logos {
                    overflow: hidden;
                    padding: 60px 0;
                    background: white;
                    white-space: nowrap;
                    position: relative;
                }

                .logos:before,
                .logos:after {
                    position: absolute;
                    top: 0;
                    width: 250px;
                    height: 100%;
                    content: "";
                    z-index: 2;
                }

                .logos:before {
                    left: 0;
                    background: linear-gradient(to left, rgba(255, 255, 255, 0), white);
                }

                .logos:after {
                    right: 0;
                    background: linear-gradient(to right, rgba(255, 255, 255, 0), white);
                }

                .logos:hover .logos-slide {
                    animation-play-state: paused;
                }

                .logos-slide {
                    display: inline-block;
                    animation: 35s slide infinite linear;
                }

                .logos-slide img {
                    height: 100px;
                    margin: 0 40px;
                }
            </style>

        </section><!-- /Sponsorship Section -->

        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Pertanyaan yang Sering Diajukan</span>
                <h2>Pertanyaan yang Sering Diajukan</h2>
                <p>Temukan jawaban atas pertanyaan yang sering diajukan mengenai Sistem Penilaian Kinerja Dosen</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10">

                        <div class="faq-container">

                            <!-- FAQ 1 -->
                            <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Apa itu Sistem Penilaian Kinerja Dosen?</h3>
                                <div class="faq-content">
                                    <p>Sistem Penilaian Kinerja Dosen adalah mekanisme digital yang dirancang untuk
                                        mengevaluasi kinerja dosen berdasarkan Beban Kerja Dosen (BKD) dan perilaku
                                        kerja. Ini bertujuan untuk meningkatkan kualitas pengajaran dan profesionalisme
                                        dosen.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <!-- FAQ 2 -->
                            <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Bagaimana cara mengakses sistem ini?</h3>
                                <div class="faq-content">
                                    <p>Dosen dapat mengakses sistem ini melalui portal kampus yang terintegrasi.
                                        Penilaian dapat dilakukan secara online dengan mengikuti prosedur yang telah
                                        ditentukan oleh universitas.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <!-- FAQ 3 -->
                            <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Apa saja kriteria penilaian dalam sistem ini?</h3>
                                <div class="faq-content">
                                    <p>Kriteria penilaian meliputi dua aspek utama: BKD yang mencakup pengajaran,
                                        penelitian, dan pengabdian kepada masyarakat, serta perilaku kerja yang menilai
                                        aspek non-akademik seperti etos kerja dan kolaborasi.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <!-- FAQ 4 -->
                            <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Bagaimana hasil penilaian digunakan?</h3>
                                <div class="faq-content">
                                    <p>Hasil penilaian digunakan sebagai dasar untuk pemberian insentif, evaluasi
                                        profesionalisme dosen, dan pengambilan keputusan strategis terkait pengembangan
                                        karier dosen di universitas.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <!-- FAQ 5 -->
                            <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Apakah mahasiswa terlibat dalam proses ini?</h3>
                                <div class="faq-content">
                                    <p>Ya, mahasiswa dapat memberikan umpan balik melalui survei evaluasi dosen yang
                                        menjadi bagian dari penilaian perilaku kerja. Hal ini memastikan penilaian
                                        dilakukan secara objektif.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Faq Section -->

    </main>

    <!-- Footer-->
    <x-footer></x-footer>


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
