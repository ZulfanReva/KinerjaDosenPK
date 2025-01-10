<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Data Dosen | E-Kinerja UMBJM'" />

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
                                href="javascript:;">Halaman</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Dosen</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Selamat Datang di halaman Data Dosen</h6>
                </nav>

                <!-- Button Logout -->
                <x-buttonlogout></x-buttonlogout>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <!-- Tombol Tambah Data -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('admin.datadosen.create') }}" class="btn btn-sm bg-gradient-info">Tambah Data</a>
            </div>

            <!-- Tabel Data Dosen Pengajar -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-2" style="margin-bottom: 10px;">
                <h6 class="mb-0" style="font-size: 1.2rem; font-weight: bold; text-align: justify;">Data Dosen Pengajar</h6>
            </div>
            <div class="card-body px-3 pt-2 pb-3">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" style="font-size: 0.9rem;">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Nama</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">NIDN</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Prodi</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Status</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Jabatan</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosenPengajar as $dosen)
                                <tr>
                                    <td class="text-start" style="padding: 10px;">{{ $dosen->nama_dosen }}</td>
                                    <td class="text-start" style="padding: 10px;">{{ $dosen->nidn }}</td>
                                    <td class="text-start" style="padding: 10px;">{{ $dosen->prodi->nama_prodi }}</td>
                                    <td class="text-start" style="padding: 10px;">
                                        <span class="badge bg-gradient-{{ $dosen->status === 'Aktif' ? 'success' : 'danger' }}">
                                            {{ ucfirst($dosen->status) }}
                                        </span>
                                    </td>
                                    <td class="text-start" style="padding: 10px;">{{ $dosen->jabatan->nama_jabatan }}</td>
                                    <td class="text-start" style="padding: 10px;">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.datadosen.edit', $dosen->id) }}" class="btn btn-sm bg-gradient-info me-2">
                                            <i class="fa fa-edit fa-xs"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <button class="btn btn-sm bg-gradient-danger" onclick="hapusData({{ $dosen->id }})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-secondary py-4" style="font-size: 1rem; padding: 15px;">
                                        <h6 class="mb-0">Belum Ada Data Dosen Pengajar</h6>
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

<!-- Tabel Data Dosen Berjabatan -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-2" style="margin-bottom: 10px;">
                <h6 class="mb-0" style="font-size: 1.2rem; font-weight: bold; text-align: justify;">Data Dosen Berjabatan</h6>
            </div>
            <div class="card-body px-3 pt-2 pb-3">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" style="font-size: 0.9rem;">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Nama</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">NIDN</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Prodi</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Status</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Jabatan</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Nama Pengguna</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Kata Sandi</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bold text-justify" style="padding: 10px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosenBerjabatan as $dosen)
                                <tr>
                                    <td class="text-start" style="padding: 10px;">{{ $dosen->nama_dosen }}</td>
                                    <td class="text-start" style="padding: 10px;">{{ $dosen->nidn }}</td>
                                    <td class="text-start" style="padding: 10px;">{{ $dosen->prodi->nama_prodi }}</td>
                                    <td class="text-start" style="padding: 10px;">
                                        <span class="badge bg-gradient-{{ $dosen->status === 'Aktif' ? 'success' : 'danger' }}">
                                            {{ ucfirst($dosen->status) }}
                                        </span>
                                    </td>
                                    <td class="text-start" style="padding: 10px;">{{ $dosen->jabatan->nama_jabatan }}</td>
                                    <td class="text-start" style="padding: 10px;">
                                        {{ $dosen->user->username ?? '-' }}
                                    </td>
                                    <td class="text-start" style="padding: 10px;">*****</td>
                                    <td class="text-start" style="padding: 10px;">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.datadosen.edit', $dosen->id) }}" class="btn btn-sm bg-gradient-info me-2">
                                            <i class="fa fa-edit fa-xs"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <button class="btn btn-sm bg-gradient-danger" onclick="hapusData({{ $dosen->id }})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-secondary py-4" style="font-size: 1rem; padding: 15px;">
                                        <h6 class="mb-0">Belum Ada Data Dosen Berjabatan</h6>
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
                    fetch(`/admin/datadosen/${selectedDataId}`, {
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
                                window.location.href = "{{ route('admin.datadosen.index') }}";
                            } else {
                                alert("Gagal menghapus data: " + data.message); // Tampilkan pesan dari server jika ada
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus data: ' + error
                                .message); // Menampilkan pesan error yang lebih jelas
                        });
                };

                // Menghapus backdrop secara manual setelah modal ditutup
                document.getElementById('confirmDeleteModal').addEventListener('hidden.bs.modal', function() {
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                });
            </script>

    </main>
</body>

</html>