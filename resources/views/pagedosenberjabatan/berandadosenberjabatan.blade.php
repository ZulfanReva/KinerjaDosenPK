<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Beranda | E-Kinerja UMBJM'" />

<body class="g-sidenav-show  bg-gray-100">
  <x-navigasidosenberjabatan></x-navigasidosenberjabatan>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
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

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Dosen Aktif</p>
                    <h5 class="font-weight-bolder mb-0">
                      150
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                    <img src="../assets/foto/dosenaktif.png" alt="dosen aktif" width="50" height="50">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Dosen Tugas Belajar</p>
                    <h5 class="font-weight-bolder mb-0">
                     17
                      </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                    <img src="../assets/foto/dosentugasbelajar.png" alt="dosen tugas belajar" width="50" height="50">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Fakultas</p>
                    <h5 class="font-weight-bolder mb-0">
                      6
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                    <img src="../assets/foto/fakultas.png" alt="fakultas" width="50" height="50">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Prodi</p>
                    <h5 class="font-weight-bolder mb-0">
                      20
                      </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                    <img src="../assets/foto/prodi.png" alt="prodi" width="50" height="50">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <div class="container-fluid py-4">
      <div class="row">
        <!-- Chart: 10 Dosen dengan Penilaian Tertinggi -->
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">5 Dosen dengan Penilaian Tertinggi</h6>
            </div>
            <div class="card-body p-3">
              <canvas id="topTenDosenChart"></canvas>
            </div>
            <!-- Nama Dosen yang Masuk Top 5 -->
            <div class="card-footer">
              <ul class="list-unstyled text-right">
                <li>(1) Nama Dosen - 95</li>
                <li>(2) Nama Dosen - 85</li>
                <li>(3) Nama Dosen - 75</li>
                <li>(4) Nama Dosen - 65</li>
                <li>(5) Nama Dosen - 55</li>
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Chart: 10 Dosen dengan Penilaian Terendah -->
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">5 Dosen dengan Penilaian Terendah</h6>
            </div>
            <div class="card-body p-3">
              <canvas id="lowTenDosenChart"></canvas>
            </div>
            <!-- Nama Dosen yang Masuk Top 5 -->
            <div class="card-footer">
              <ul class="list-unstyled text-right">
                <li>(1) Nama Dosen - 15</li>
                <li>(2) Nama Dosen - 25</li>
                <li>(3) Nama Dosen - 35</li>
                <li>(4) Nama Dosen - 45</li>
                <li>(5) Nama Dosen - 50</li>
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Chart: 3 Fakultas dengan Dosen Terbaik -->
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Fakultas dengan Dosen Terbaik</h6>
            </div>
            <div class="card-body p-3">
              <canvas id="topFacultiesChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    
      <div class="row mt-4">
        <!-- Footer -->
        <footer class="footer pt-3">
          <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
              <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                  © <script>document.write(new Date().getFullYear())</script>,
                  created by <a href="#" class="font-weight-bold" target="_blank">Universitas Muhammadiyah Banjarmasin</a>.
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    
    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      // Chart: 10 Dosen dengan Penilaian Tertinggi
      const topTenDosenCtx = document.getElementById('topTenDosenChart').getContext('2d');
      const topTenDosenChart = new Chart(topTenDosenCtx, {
        type: 'bar',
        data: {
          labels: ['1', '2', '3', '4', '5'],
          datasets: [{
            label: 'Nilai',
            data: [95, 94, 93, 92, 91],
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
    
      // Chart: 10 Dosen dengan Penilaian Terendah
      const lowTenDosenCtx = document.getElementById('lowTenDosenChart').getContext('2d');
      const lowTenDosenChart = new Chart(lowTenDosenCtx, {
        type: 'bar',
        data: {
          labels: ['1', '2', '3', '4', '5'],
          datasets: [{
            label: 'Nilai',
            data: [50, 52, 53, 54, 55],
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
    
       // Chart: Fakultas dengan Dosen Terbaik
      const topFacultiesCtx = document.getElementById('topFacultiesChart').getContext('2d');
      const topFacultiesChart = new Chart(topFacultiesCtx, {
        type: 'pie',
        data: {
          labels: ['Fakultas Teknik', 'Fakultas Farmasi', 'Fakultas Psikologi', 'Fakultas FKIP', 'Fakultas FKIK', 'Fakultas FAI', 'Fakultas Pasca Sarjana'],
          datasets: [{
            label: 'Jumlah Dosen Terbaik',
            data: [20, 15, 10, 8, 5, 7, 4],
            backgroundColor: [
              'rgba(54, 162, 235, 0.6)',
              'rgba(255, 206, 86, 0.6)',
              'rgba(75, 192, 192, 0.6)',
              'rgba(153, 102, 255, 0.6)',
              'rgba(255, 159, 64, 0.6)',
              'rgba(255, 99, 132, 0.6)',
              'rgba(201, 203, 207, 0.6)'
            ],
            borderColor: [
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(201, 203, 207, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true
        }
      });

    </script>    
    
  </main>

</body>

</html>