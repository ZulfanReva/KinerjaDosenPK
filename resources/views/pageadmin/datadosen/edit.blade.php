<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Edit Data Dosen | E-Kinerja UMBJM'" />

<body class="g-sidenav-show bg-gray-100">
    <x-navigasiadmin></x-navigasiadmin>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin.datadosen.index') }}">Data Dosen</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Data</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Edit Data Dosen</h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Edit Data Dosen</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="p-4">
                                <form id="formContainer" method="POST" action="{{ route('admin.datadosen.update', $dosen->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group mb-4">
                                        <div class="row">
                                            <!-- Input Nama -->
                                            <div class="col-md-3 mb-3">
                                                <label for="nama_dosen" class="form-label">Nama</label>
                                                <input type="text" id="nama_dosen" name="nama_dosen" class="form-control" placeholder="Masukkan Nama" value="{{ old('nama_dosen', $dosen->nama_dosen) }}">
                                            </div>

                                            <!-- Input NIDN -->
                                            <div class="col-md-3 mb-3">
                                                <label for="nidn" class="form-label">NIDN</label>
                                                <input type="text" id="nidn" name="nidn" class="form-control" placeholder="Masukkan NIDN" value="{{ old('nidn', $dosen->nidn) }}">
                                            </div>

                                            <!-- Dropdown Prodi -->
                                            <div class="col-md-3 mb-3">
                                                <label for="prodi" class="form-label">Prodi</label>
                                                <select id="prodi" name="prodi_id" class="form-select">
                                                    <option value="">Pilih Prodi</option>
                                                    @foreach ($prodis as $prodi)
                                                        <option value="{{ $prodi->id }}" {{ $prodi->id == old('prodi_id', $dosen->prodi_id) ? 'selected' : '' }}>
                                                            {{ $prodi->nama_prodi }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Dropdown Status -->
                                            <div class="col-md-3 mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select id="status" name="status" class="form-select">
                                                    <option value="Aktif" {{ $dosen->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="Nonaktif" {{ $dosen->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <!-- Tombol Simpan -->
                                        <button type="submit" class="btn bg-gradient-info" id="saveButton">Simpan</button>

                                        <!-- Tombol Kembali -->
                                        <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('admin.datadosen.index') }}'">
                                            Kembali
                                        </button>
                                    </div>
                                </form>

                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
              document.getElementById('formContainer').addEventListener('submit', function (event) {
                  event.preventDefault(); // Mencegah form disubmit secara default
  
                  const formData = new FormData(this); // Mengambil data form
                  const data = {};  // Data untuk dikirim ke server
  
                  formData.forEach((value, key) => {
                      data[key] = value;
                  });
  
                  // Mengirim data ke server menggunakan fetch
                  fetch("{{ route('admin.datadosen.update', $dosen->id) }}", {
                      method: "PUT",
                      headers: {
                          'Content-Type': 'application/json',
                          'X-CSRF-TOKEN': csrfToken
                      },
                      body: JSON.stringify(data)
                  })
                  .then(response => response.json())  // Mengambil response dalam format JSON
                  .then(data => {
                      if (data.success) {
                          alert("Data dosen berhasil diperbarui!");
                          window.location.href = "{{ route('admin.datadosen.index') }}";  // Redirect ke halaman index
                      } else {
                          alert(`Gagal mengupdate data: ${data.message}`);
                      }
                  })
                  .catch(error => {
                      console.error("Error:", error);
                      alert(`Terjadi kesalahan: ${error.message}`);
                  });
              });
          </script>

    </main>
</body>

</html>
