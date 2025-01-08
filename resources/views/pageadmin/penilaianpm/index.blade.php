<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Penilaian PM | E-Kinerja UMBJM'" />

<body class="g-sidenav-show  bg-gray-100">
  <x-navigasiadmin></x-navigasiadmin>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin.penilaianpm.index') }}">Beranda</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Penilaian PM</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Selamat Datang di Halaman Penilaian PM</h6>
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
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Tabel Penilaian Dosen (Admin)</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Nama</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">NIDN</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Prodi</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Periode</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai CF (BKD)</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai SF (PK)</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai PM</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    @forelse ($dataDosen as $dosen)
                        <tr>
                            <td class="text-start">
                                <h6 class="mb-0 text-sm">{{ $dosen->nama_dosen }}</h6>
                            </td>
                            <td class="text-start">
                                <p class="text-xs font-weight-bold mb-0">{{ $dosen->nidn }}</p>
                            </td>
                            <td class="text-start">
                                <p class="text-xs font-weight-bold mb-0">{{ $dosen->prodi->nama_prodi ?? '-' }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="badge bg-gradient-success btn-sm mb-0">Aktif</span>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-xs font-weight-bold mb-0">{{ $dosen->penilaianPK->periode->nama_periode ?? '-' }}</p>
                            </td>
                            <td class="align-middle text-center">
                                @if($dosen->penilaianBKD) 
                                    <!-- Jika sudah ada nilai BKD, tampilkan nilai tersebut -->
                                    <span>{{ $dosen->penilaianBKD->nilai_ncf ?? '-' }}</span>
                                @else
                                    <!-- Jika belum ada nilai BKD, tampilkan tombol Nilai -->
                                    <a href="{{ route('admin.penilaianbkd.create', ['dosen_id' => $dosen->id]) }}" class="btn bg-gradient-danger btn-sm mb-0">Nilai</a>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <span>{{ $dosen->penilaianPK->nilai_nsf ?? '-' }}</span>
                            </td>
                            <td class="align-middle text-center">
                                @if($dosen->nilai_pm)
                                    <span>{{ $dosen->nilai_pm }}</span>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <!-- Button untuk melihat detail -->
                                <button class="btn btn-sm bg-gradient-info me-2">
                                    <i class="fa fa-eye fa-xs"></i>
                                </button>
                                
                                <!-- Button untuk menghapus data -->
                                <form action="{{ route('admin.penilaianpm.destroy', $dosen->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm bg-gradient-danger me-2">
                                        <i class="fa fa-trash fa-xs"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-secondary py-4">
                                <h6 class="mb-0">BELUM ADA DATA PENILAIAN PM</h6>
                            </td>
                        </tr>
                    @endforelse
                  </tbody>
                
                
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    
      <!-- Modal Konfirmasi Hapus -->
      <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
              <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Ya</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      let selectedDataId = null;
    
      // Fungsi untuk menampilkan modal konfirmasi
      function hapusData(id) {
        selectedDataId = id; // Menyimpan ID data yang akan dihapus
        const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal')); // Inisialisasi modal
        modal.show(); // Menampilkan modal
      }
    
      // Menangani klik tombol "Ya" pada modal
      document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        const dataId = selectedDataId; // Mengambil ID data yang dipilih
    
        // Logika penghapusan data bisa ditambahkan di sini (misalnya melalui AJAX)
        alert("Data dengan ID " + dataId + " berhasil dihapus.");
        
        // Menutup modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('confirmDeleteModal'));
        modal.hide();
    
        // Redirect atau perbarui halaman
        window.location.href = "penilaianpm.html"; // Atau sesuaikan dengan kebutuhan
      });
    </script>

  </main>
</body>

</html>