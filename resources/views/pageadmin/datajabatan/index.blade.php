<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Data Jabatan | E-Kinerja UMBJM'" />

<body class="g-sidenav-show  bg-gray-100">
  <x-navigasiadmin></x-navigasiadmin>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Beranda</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Selamat Datang di halaman Data Jabatan</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
          
          <!-- Button Logout -->
          <x-buttonlogout></x-buttonlogout>

        </div>
      </div>
    </nav>

    @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
    @endif

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
              <h6 class="mb-0">Tabel Data Jabatan</h6>
              <a href="{{ route('admin.datajabatan.create') }}" class="btn btn-sm bg-gradient-info btn-sm mb-0">Tambah Data</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Jabatan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($jabatans as $jabatan)
                      <tr>
                          <td class="text-start">
                              <div class="d-flex px-2 py-1">
                                  <div class="d-flex flex-column justify-content-center">
                                      <h6 class="mb-0 text-sm">{{ $jabatan->nama_jabatan }}</h6> <!-- Menampilkan nama jabatan -->
                                  </div>
                              </div>
                          </td>
                          <td class="align-middle text-center">
                              <button 
                                  class="btn btn-sm bg-gradient-danger me-2" 
                                  onclick="hapusData({{ $jabatan->id }})" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#confirmDeleteModal">
                                  <i class="fa fa-trash fa-xs"></i>
                              </button>
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="5" class="text-center text-secondary py-4">
                              <h6 class="mb-0">BELUM ADA DATA JABATAN</h6>
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
                  Apakah Anda yakin ingin menghapus data jabatan ini?
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Ya</button>
              </div>
          </div>
      </div>
    </div>

  </div>

  <script>
    let selectedDataId = null;

    // Fungsi untuk menyimpan ID data yang dipilih untuk dihapus
    function hapusData(id) {
        selectedDataId = id; // Simpan ID data
    }

    // Event handler untuk konfirmasi hapus
    document.getElementById('confirmDeleteBtn').onclick = () => {
        fetch(`/admin/datajabatan/${selectedDataId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        })
        .then(response => {
            // Pastikan status response adalah OK
            if (response.ok) {
                return response.json(); // Mengambil JSON dari respons jika statusnya 200-299
            } else {
                throw new Error('Gagal menghapus data. Status: ' + response.status);
            }
        })
        .then(data => {
            if (data.success) {
                // Sembunyikan modal secara manual
                const modalElement = document.getElementById('confirmDeleteModal');
                modalElement.style.display = 'none'; // Sembunyikan modal
                modalElement.classList.remove('show'); // Hapus kelas 'show'

                // Menampilkan pesan sukses
                alert(data.message);

                // Menyegarkan halaman atau mengarahkan ke halaman index
                window.location.href = "{{ route('admin.datajabatan.index') }}";
            } else {
                alert("Gagal menghapus data: " + data.message); // Tampilkan pesan dari server jika ada
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data: ' + error.message); // Menampilkan pesan error yang lebih jelas
        });
    };

    // Menghapus backdrop secara manual setelah modal ditutup
    document.getElementById('confirmDeleteModal').addEventListener('hidden.bs.modal', function () {
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
    });
  </script>

  <x-footeradminpengawas></x-footeradminpengawas>
  
</main>

</body>

</html>