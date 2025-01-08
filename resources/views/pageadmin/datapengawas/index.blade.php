<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Data Pengawas | E-Kinerja UMBJM'" />

<body class="g-sidenav-show bg-gray-100">
  <x-navigasiadmin></x-navigasiadmin>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Pengawas</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Selamat Datang di halaman Data Pengawas</h6>
        </nav>
        
        <!-- Button Logout -->
        <x-buttonlogout></x-buttonlogout>

      </div>
    </nav>
    <!-- End Navbar -->
    

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <!-- Header dengan tombol Tambah Data -->
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
              <h6 class="mb-0">Tabel Data Pengawas</h6>
              <a href="{{ route('admin.datapengawas.create') }}" class="btn btn-sm bg-gradient-info btn-sm mb-0">Tambah Data</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Nama Pengawas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Jabatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Nama Pengguna</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Kata Sandi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($pengawas as $pengawasItem)
                    <tr>
                      <td class="text-start">
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $pengawasItem->nama_pengawas }}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="text-start">
                        <p class="text-xs font-weight-bold mb-0">{{ $pengawasItem->jabatan->nama_jabatan }}</p> 
                      </td>
                      <td class="text-start">
                        {{-- @dump($pengawasItem->user) <!-- Tambahkan ini untuk debugging --> --}}
                        <p class="text-xs font-weight-bold mb-0">{{ $pengawasItem->user ? $pengawasItem->user->username : 'Username tidak tersedia' }}</p>
                      </td>                   
                      <td class="align-middle text-start text-sm">
                        <p class="text-xs font-weight-bold mb-0">******</p>
                      </td>
                      <td class="align-middle text-center">
                        <a href="{{ route('admin.datapengawas.edit', $pengawasItem->id) }}" class="btn btn-sm bg-gradient-info me-2">
                          <i class="fa fa-edit fa-xs"></i>
                        </a>
                          <!-- Tombol hapus dengan modal konfirmasi -->
                          <button 
                            class="btn btn-sm bg-gradient-danger me-2" 
                            onclick="hapusData({{ $pengawasItem->id }})" 
                            data-bs-toggle="modal" 
                            data-bs-target="#confirmDeleteModal">
                            <i class="fa fa-trash fa-xs"></i>
                          </button>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="5" class="text-center text-secondary py-4">
                        <h6 class="mb-0">BELUM ADA DATA PENGAWAS</h6>
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
      <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data pengawas ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Ya</button>
                </div>
            </div>
        </div>
      </div>

    </div>

    <!-- Footer -->
    <x-footeradminpengawas></x-footeradminpengawas>

    <script>
      let selectedDataId = null;
  
      // Fungsi untuk menyimpan ID data yang dipilih untuk dihapus
      function hapusData(id) {
          selectedDataId = id; // Simpan ID data
      }
  
      // Event handler untuk konfirmasi hapus
      document.getElementById('confirmDeleteBtn').onclick = () => {
          fetch(`/admin/datapengawas/${selectedDataId}`, {
              method: 'DELETE',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              }
          })
          .then(response => {
              if (response.ok) {
                  return response.json();
              } else {
                  throw new Error('Gagal menghapus data. Status: ' + response.status);
              }
          })
          .then(data => {
              if (data.success) {
                  const modalElement = document.getElementById('confirmDeleteModal');
                  modalElement.style.display = 'none';
                  modalElement.classList.remove('show');
                  alert(data.message);
                  window.location.href = "{{ route('admin.datapengawas.index') }}";
              } else {
                  alert("Gagal menghapus data: " + data.message);
              }
          })
          .catch(error => {
              console.error('Error:', error);
              alert('Terjadi kesalahan saat menghapus data: ' + error.message);
          });
      };

      document.getElementById('confirmDeleteModal').addEventListener('hidden.bs.modal', function () {
          selectedDataId = null; // Reset ID setelah modal ditutup
      });
    </script>
</body>

</html>
