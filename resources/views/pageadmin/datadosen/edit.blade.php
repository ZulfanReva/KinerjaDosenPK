<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Edit Data Dosen | E-Kinerja UMBJM'" />

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
                                <form method="POST" action="{{ route('admin.datadosen.update', $dosen->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div id="formGroup">
                                        <div class="form-group row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <label for="nama_dosen" class="form-label">Nama Dosen</label>
                                                <input type="text" name="nama_dosen" class="form-control"
                                                    placeholder="Masukkan Nama Dosen"
                                                    value="{{ old('nama_dosen', $dosen->nama_dosen) }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="nidn" class="form-label">NIDN</label>
                                                <input type="text" name="nidn" class="form-control"
                                                    placeholder="Masukkan NIDN" value="{{ old('nidn', $dosen->nidn) }}">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <label for="prodi" class="form-label">Prodi</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $dosen->prodi->nama_prodi }}" readonly
                                                    style="font-style: italic; background-color: #f5f5f5; border: 1px solid #ddd;">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="Aktif"
                                                        {{ old('status', $dosen->status) == 'Aktif' ? 'selected' : '' }}>
                                                        Aktif</option>
                                                    <option value="Nonaktif"
                                                        {{ old('status', $dosen->status) == 'Nonaktif' ? 'selected' : '' }}>
                                                        Nonaktif</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <label for="jabatan" class="form-label">Jabatan</label>
                                                <input type="text" id="jabatanInput" class="form-control"
                                                    value="{{ $dosen->jabatan->nama_jabatan }}" readonly
                                                    style="font-style: italic; background-color: #f5f5f5; border: 1px solid #ddd;">
                                            </div>
                                        </div>

                                        <div id="userFields" style="display: none;">
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class="form-label">Nama Pengguna</label>
                                                    <input type="text" name="username" class="form-control" readonly
                                                        value="{{ old('username', $dosen->user->username ?? '') }}"
                                                        style="font-style: italic; background-color: #f5f5f5; border: 1px solid #ddd;">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="password" class="form-label">Kata Sandi</label>
                                                    <input type="password" name="password" class="form-control" readonly
                                                        value="{{ old('password', $dosen->user->password ?? '') }}"
                                                        style="font-style: italic; background-color: #f5f5f5; border: 1px solid #ddd;">
                                                </div>
                                            </div>
                                            <div id="jabatanNote" style="font-size: 0.9rem; color: gray;">
                                                *Nama Pengguna dan Kata Sandi hanya bisa diedit oleh user pemilik.
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mt-4">
                                            <div class="d-flex" style="gap: 10px;">
                                                <button type="submit" class="btn bg-gradient-info">Simpan</button>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    onclick="window.location.href='{{ route('admin.datadosen.index') }}'">Kembali</button>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const jabatanInput = document.getElementById('jabatanInput').value.trim();
                                            const userFields = document.getElementById('userFields');

                                            // Tampilkan atau sembunyikan berdasarkan jabatan
                                            if (jabatanInput !== 'DOSEN PENGAJAR') {
                                                userFields.style.display = 'block';
                                            } else {
                                                userFields.style.display = 'none';
                                            }
                                        });
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
