<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Tambah Data Prodi | E-Kinerja UMBJM'" />
<meta name="csrf-token" content="{{ csrf_token() }}">


<body class="g-sidenav-show  bg-gray-100">
  <x-navigasiadmin></x-navigasiadmin>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah Data Prodi</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Selamat Datang di halaman Tambah Data Prodi</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <!-- Tombol Keluar -->
              <a class="btn btn-outline-info btn-sm mb-0 me-3" data-bs-toggle="modal" data-bs-target="#logoutModal">Keluar</a>
          
              <!-- Modal Konfirmasi Keluar -->
              <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Keluar</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Apakah Anda yakin ingin keluar dari akun?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    
                      <!-- Form logout -->
                      <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn bg-gradient-info">Keluar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>

        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Tambah Data Prodi</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="p-4">
                <!-- Form tambah data prodi -->
                <form id="formContainer" method="POST" action="{{ route('admin.dataprodi.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div id="formGroup">
                      <div class="form-group mb-4">
                          <div class="row">
                              <div class="col-md-6 mb-3">
                                  <label for="nama_prodi[]" class="form-label">Nama Prodi</label>
                                  <input type="text" name="nama_prodi[]" class="form-control" placeholder="Masukkan Nama Prodi" required>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div id="additionalForms"></div>
                  <div class="d-flex justify-content-between mt-4">
                    <!-- Tombol Simpan dan Kembali (bersebelahan) -->
                    <div class="d-flex" style="gap: 10px;"> <!-- Menambahkan jarak menggunakan gap -->
                        <button type="submit" class="btn bg-gradient-info">Simpan</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('admin.dataprodi.index') }}'">Kembali</button>
                    </div>
                
                    <!-- Tombol Tambah Form di sebelah kanan -->
                    <button type="button" class="btn btn-outline-info" id="addFormButton">
                        <i class="fa fa-plus"></i> Tambah Form
                    </button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      document.getElementById('addFormButton').addEventListener('click', () => {
    const newForm = document.createElement('div');
    newForm.classList.add('form-group', 'mb-4');
    newForm.innerHTML = `
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nama_prodi[]" class="form-label">Nama Prodi</label>
                <input type="text" name="nama_prodi[]" class="form-control" placeholder="Masukkan Nama Prodi" required>
            </div>
        </div>
    `;
    document.getElementById('additionalForms').appendChild(newForm);
    });

    // Seleksi elemen yang diperlukan
    const formContainer = document.getElementById('formContainer');

    // Event untuk tombol submit
    formContainer.addEventListener('submit', function (event) {
        event.preventDefault(); // Mencegah submit default

        // Mengambil semua input dengan nama "nama_prodi[]"
        const prodiInputs = document.querySelectorAll('input[name="nama_prodi[]"]');
        let prodiData = [];

        // Ambil nilai dari setiap input, validasi jika kosong
        prodiInputs.forEach(input => {
            if (input.value.trim() === "") {
                alert("Semua field harus diisi!");
                throw new Error("Field kosong ditemukan");
            }
            prodiData.push(input.value);
        });

        // Buat objek data untuk dikirim
        const data = {
            nama_prodi: prodiData,
        };

        // Kirim data ke server menggunakan fetch
        fetch("{{ route('admin.dataprodi.store') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data),
        })
        .then(response => {
            // Validasi apakah response adalah JSON atau redirect
            if (response.headers.get('content-type')?.includes('application/json')) {
                return response.json();
            } else if (response.redirected) {
                window.location.href = response.url; // Redirect jika diperlukan
                return;
            } else {
                throw new Error("Respon server tidak valid.");
            }
        })
        .then(data => {
            if (data && data.message) {
                alert(data.message); // Tampilkan pesan dari server jika ada
            }
            alert("Data Prodi berhasil disimpan!"); // Pesan sukses tambahan
            window.location.href = "{{ route('admin.dataprodi.index') }}"; // Redirect ke halaman index
        })
        .catch(error => {
            console.error("Error:", error);
            alert(`Gagal menyimpan data: ${error.message}`);
        });
    });
    </script>
    
  </main>

</body>

</html>