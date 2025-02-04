<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Beranda | E-Kinerja UMBJM'" />

<body class="g-sidenav-show  bg-gray-100">
    <x-navigasidosenberjabatan></x-navigasidosenberjabatan>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                href="javascript:;">Halaman</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Beranda</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Selamat Datang di halaman Beranda</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    </div>

                    <!-- Button Logout -->
                    <x-buttonlogout></x-buttonlogout>

                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <!-- Chart: 5 Dosen dengan Penilaian Tertinggi -->
                <div class="col-12 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">5 Dosen dengan Penilaian Tertinggi</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="topTenDosenChart"></canvas>
                            <ul class="list-unstyled text-right">
                                @foreach ($topDosen as $index => $dosen)
                                    <li>({{ $index + 1 }}) {{ $dosen->nama_dosen }} - {{ $dosen->total_nilai }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Chart: 5 Dosen dengan Penilaian Terendah -->
                <div class="col-12 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">5 Dosen dengan Penilaian Terendah</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="lowTenDosenChart"></canvas>
                            <ul class="list-unstyled text-right">
                                @foreach ($lowDosen as $index => $dosen)
                                    <li>({{ $index + 1 }}) {{ $dosen->nama_dosen }} - {{ $dosen->total_nilai }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Dosen Dengan Grade A</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="prodiGradeAChart"></canvas>
                        <ul class="list-unstyled text-right">
                            @foreach ($prodiWithGradeA as $prodi)
                                <li>{{ $prodi->nama_prodi }} - {{ $prodi->total_dosen }} Dosen</li>
                            @endforeach
                        </ul>
                    </div>
                </div> --}}

            </div>
        </div>

        <!-- Footer -->
        <footer class="footer pt-3">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            created by <a href="#" class="font-weight-bold" target="_blank">Universitas
                                Muhammadiyah Banjarmasin</a>.
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Chart.js Library -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Chart: 5 Dosen dengan Penilaian Tertinggi
            const topTenDosenCtx = document.getElementById('topTenDosenChart').getContext('2d');
            const topTenDosenChart = new Chart(topTenDosenCtx, {
                type: 'bar',
                data: {
                    labels: ['1', '2', '3', '4', '5'], // Label numerik
                    datasets: [{
                        label: 'Nilai',
                        data: [
                            @foreach ($topDosen as $dosen)
                                {{ $dosen->total_nilai }},
                            @endforeach
                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Chart: 5 Dosen dengan Penilaian Terendah
            const lowTenDosenCtx = document.getElementById('lowTenDosenChart').getContext('2d');
            const lowTenDosenChart = new Chart(lowTenDosenCtx, {
                type: 'bar',
                data: {
                    labels: ['1', '2', '3', '4', '5'], // Label numerik
                    datasets: [{
                        label: 'Nilai',
                        data: [
                            @foreach ($lowDosen as $dosen)
                                {{ $dosen->total_nilai }},
                            @endforeach
                        ],
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Chart: Prodi dengan Dosen Bergrade A
            const prodiGradeAChartCtx = document.getElementById('prodiGradeAChart').getContext('2d');
            const prodiGradeAChart = new Chart(prodiGradeAChartCtx, {
                type: 'pie',
                data: {
                    labels: [
                        @foreach ($prodiWithGradeA as $prodi)
                            '{{ $prodi->nama_prodi }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Jumlah Dosen Bergrade A',
                        data: [
                            @foreach ($prodiWithGradeA as $prodi)
                                {{ $prodi->total_dosen }},
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true, // Disable responsiveness

                }
            });
        </script>

    </main>

</body>

</html>
