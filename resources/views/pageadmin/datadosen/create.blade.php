<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Tambah Data Dosen | E-Kinerja UMBJM'" />

<body class="g-sidenav-show bg-gray-100">
    <x-navigasiadmin></x-navigasiadmin>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                href="{{ route('admin.datadosen.index') }}">Data Dosen</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah Data</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Tambah Data Dosen</h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Tambah Data Dosen</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="p-4">
                                <form method="POST" action="{{ route('admin.datadosen.store') }}">
                                    @csrf
                                    <div id="formGroup">
                                        <div class="form-group row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <label for="nama_dosen[]" class="form-label">Nama Dosen</label>
                                                <input type="text" name="nama_dosen[]" class="form-control"
                                                    placeholder="Masukkan Nama Dosen" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="nidn[]" class="form-label">NIDN</label>
                                                <input type="text" name="nidn[]" class="form-control"
                                                    placeholder="Masukkan NIDN" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <label for="prodi[]" class="form-label">Prodi</label>
                                                <select name="prodi_id[]" class="form-select" required>
                                                    <option value="" selected disabled>Pilih Prodi</option>
                                                    @foreach ($prodis as $prodi)
                                                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="status[]" class="form-label">Status</label>
                                                <select name="status[]" class="form-select" required>
                                                    <option value="" selected disabled>Pilih Status</option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Nonaktif">Nonaktif</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <label for="jabatan[]" class="form-label">Jabatan</label>
                                                <select name="jabatan_id[]" class="form-select" id="jabatanSelect"
                                                    required>
                                                    <option value="" selected disabled>Pilih Jabatan</option>
                                                    @foreach ($jabatans as $jabatan)
                                                        <option value="{{ $jabatan->id }}">
                                                            {{ $jabatan->nama_jabatan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Kolom Nama Pengguna, Kata Sandi, dan Konfirmasi Kata Sandi -->
                                        <div id="additionalFields" style="display: none;">
                                            <div class="form-group row mb-3">
                                                <div class="col-md-4 mb-3">
                                                    <label for="username[]" class="form-label">Nama Pengguna</label>
                                                    <input type="text" name="username[]" class="form-control"
                                                        placeholder="Masukkan Nama Pengguna">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="password[]" class="form-label">Kata Sandi</label>
                                                    <input type="password" name="password[]"
                                                        class="form-control password-field"
                                                        placeholder="Masukkan Kata Sandi" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="password_confirmation[]" class="form-label">Konfirmasi
                                                        Kata Sandi</label>
                                                    <input type="password" name="password_confirmation[]"
                                                        class="form-control confirm-password-field"
                                                        placeholder="Konfirmasi Kata Sandi" required>
                                                    <small id="passwordMismatchError" class="text-danger"
                                                        style="display: none;">
                                                        Kata sandi tidak cocok!
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Script Validasi Kata Sandi -->
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                const passwordFields = document.querySelectorAll('.password-field');
                                                const confirmPasswordFields = document.querySelectorAll('.confirm-password-field');
                                                const errorText = document.getElementById('passwordMismatchError');
                                                const form = document.querySelector("form");

                                                form.addEventListener("submit", function(event) {
                                                    let isValid = true;

                                                    passwordFields.forEach((passwordField, index) => {
                                                        const password = passwordField.value;
                                                        const confirmPassword = confirmPasswordFields[index].value;

                                                        if (password !== confirmPassword) {
                                                            isValid = false;
                                                            errorText.style.display = "block";
                                                        } else {
                                                            errorText.style.display = "none";
                                                        }
                                                    });

                                                    if (!isValid) {
                                                        event.preventDefault(); // Mencegah pengiriman form jika password tidak cocok
                                                    }
                                                });
                                            });
                                        </script>

                                        <!-- Logika untuk kolom jabatan -->
                                        <script>
                                            // Elemen yang diperlukan
                                            const jabatanSelect = document.getElementById('jabatanSelect');
                                            const additionalFields = document.getElementById('additionalFields');

                                            // Event Listener untuk perubahan pada dropdown Jabatan
                                            jabatanSelect.addEventListener('change', function() {
                                                const selectedOption = jabatanSelect.options[jabatanSelect.selectedIndex].text;

                                                // Tampilkan atau sembunyikan kolom tambahan berdasarkan pilihan
                                                if (selectedOption !== 'DOSEN PENGAJAR') {
                                                    additionalFields.style.display = 'block'; // Tampilkan kolom
                                                } else {
                                                    additionalFields.style.display = 'none'; // Sembunyikan kolom
                                                }
                                            });
                                        </script>
                                    </div>

                                    <div id="additionalForms"></div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <!-- Tombol Simpan dan Kembali (bersebelahan) -->
                                        <div class="d-flex" style="gap: 10px;">
                                            <!-- Menambahkan jarak menggunakan gap -->
                                            <button type="submit" class="btn bg-gradient-info">Simpan</button>
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="window.location.href='{{ route('admin.datadosen.index') }}'">Kembali</button>
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
    </main>

    <script>
        // Menambahkan form dinamis untuk input dosen tambahan
        document.getElementById('addFormButton').addEventListener('click', () => {
            const formGroup = document.getElementById('formGroup'); // Mengacu pada div utama dalam form
            const newForm = document.createElement('div');
            newForm.classList.add('form-group', 'mb-4');
            newForm.innerHTML = `
            <div class="form-group row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="nama_dosen[]" class="form-label">Nama Dosen</label>
                    <input type="text" name="nama_dosen[]" class="form-control" placeholder="Masukkan Nama Dosen" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nidn[]" class="form-label">NIDN</label>
                    <input type="text" name="nidn[]" class="form-control" placeholder="Masukkan NIDN" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="prodi[]" class="form-label">Prodi</label>
                    <select name="prodi_id[]" class="form-select" required>
                        <option value="" selected disabled>Pilih Prodi</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status[]" class="form-label">Status</label>
                    <select name="status[]" class="form-select" required>
                        <option value="" selected disabled>Pilih Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="jabatan[]" class="form-label">Jabatan</label>
                    <select name="jabatan_id[]" class="form-select jabatan-select" required>
                        <option value="" selected disabled>Pilih Jabatan</option>
                        @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="additionalFields" style="display: none;">
                <div class="form-group row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="username[]" class="form-label">Nama Pengguna</label>
                        <input type="text" name="username[]" class="form-control" placeholder="Masukkan Nama Pengguna">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="password[]" class="form-label">Kata Sandi</label>
                        <input type="password" name="password[]" class="form-control password-field" placeholder="Masukkan Kata Sandi">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="password_confirmation[]" class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation[]" class="form-control confirm-password-field" placeholder="Konfirmasi Kata Sandi">
                        <small class="text-danger passwordMismatchError" style="display: none;">
                            Kata sandi tidak cocok!
                        </small>
                    </div>
                </div>
            </div>
        `;

            formGroup.appendChild(newForm);

            // Tambahkan logika untuk dropdown jabatan setelah form baru ditambahkan
            const jabatanSelect = newForm.querySelector('.jabatan-select');
            const additionalFields = newForm.querySelector('.additionalFields');

            jabatanSelect.addEventListener('change', function() {
                const selectedOption = jabatanSelect.options[jabatanSelect.selectedIndex].text;
                if (selectedOption !== 'DOSEN PENGAJAR') {
                    additionalFields.style.display = 'block';
                } else {
                    additionalFields.style.display = 'none';
                }
            });
        });

        // Seleksi elemen yang diperlukan
        const formContainer = document.getElementById('formContainer');

        // Event untuk tombol submit
        formContainer.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah submit default

            const formData = new FormData(formContainer); // Menggunakan FormData untuk mengambil data dari form

            // Konversi FormData menjadi objek JSON
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            // Kirim data ke server menggunakan fetch
            fetch("{{ route('admin.datadosen.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json', // Mengirim data dalam format JSON
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(data), // Mengirim data sebagai JSON
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
                    console.log(data); // Tambahkan ini untuk melihat respons dari server
                    if (data.success) {
                        alert("Data dosen berhasil disimpan!");
                        window.location.href = "{{ route('admin.datadosen.index') }}";
                    } else {
                        alert(data.message); // Jika ada pesan error dari server
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert(`Gagal menyimpan data: ${error.message}`);
                });
        });
    </script>
</body>

</html>
