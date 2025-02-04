<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Penilaian | E-Kinerja UMBJM'" />

<body class="g-sidenav-show bg-gray-100">
    <x-navigasiadmin></x-navigasiadmin>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                href="javascript:;">Halaman</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Penilaian</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Selamat Datang di halaman Penilaian</h6>
                </nav>
                <x-buttonlogout></x-buttonlogout>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Modal Filter -->
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterModalLabel">Filter Penilaian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="filterForm" method="GET"
                            action="{{ route('admin.penilaianprofilematching.index') }}">
                            <div class="mb-3">
                                <label for="prodi" class="form-label">Prodi</label>
                                <select class="form-select" id="prodi" name="prodi">
                                    <option value="">Semua Prodi</option>
                                    @foreach ($prodiList as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="periode" class="form-label">Periode</label>
                                <select class="form-select" id="periode" name="periode">
                                    <option value="">Semua Periode</option>
                                    @foreach ($periodeList as $periode)
                                        <option value="{{ $periode }}">{{ $periode }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn bg-gradient-info">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>Tabel Data Penilaian Perilaku Kerja</h6>
                            <div>
                                <!-- Button Filter -->
                                <button class="btn btn-sm bg-gradient-info me-2" data-bs-toggle="modal"
                                    data-bs-target="#filterModal" title="Filter Data">
                                    <i class="fa fa-filter" style="font-size:10px"></i> Filter
                                </button>
                                <!-- Button dengan icon PDF -->
                                {{-- <button class="btn btn-sm bg-gradient-info me-2"
                                    onclick="window.location.href='{{ route('admin.penilaianprofilematching.export-pdf', request()->all()) }}'"
                                    title="Rekap Data">
                                    <i class="fa fa-file-pdf" style="font-size:10px"></i> Rekap Data
                                </button> --}}
                                <button class="btn btn-sm bg-gradient-info me-2"
                                    onclick="window.location.href='{{ route('admin.penilaianprofilematching.export-pdf', request()->all()) }}'"
                                    title="Rekap Data">
                                    <i class="fa fa-print" style="font-size:10px"></i> Rekap Data
                                </button>
                                
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">
                                                Nama Dosen
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">
                                                NIDN
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">
                                                Prodi
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Status
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Periode
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Tanggal Penilaian
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Nilai
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Grade
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Dosen Penilai
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($penilaianPerilaku as $penilaian)
                                            <tr>
                                                <td class="text-start">
                                                    {{ $penilaian->dosen->nama_dosen }}
                                                </td>
                                                <td class="text-start">
                                                    {{ $penilaian->dosen->nidn }}
                                                </td>
                                                <td class="text-start">
                                                    {{ $penilaian->dosen->prodi->nama_prodi ?? '-' }}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-gradient-success">Aktif</span>
                                                </td>
                                                <td class="text-center">
                                                    {{ $penilaian->periode }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $penilaian ? \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->format('d-m-Y') : '-' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $penilaian->total_nilai }}
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $nilai = $penilaian->total_nilai;
                                                        $grade =
                                                            $nilai >= 4.56
                                                                ? 'A'
                                                                : ($nilai >= 3.56
                                                                    ? 'B'
                                                                    : ($nilai >= 2.56
                                                                        ? 'C'
                                                                        : ($nilai >= 1.56
                                                                            ? 'D'
                                                                            : 'E')));
                                                    @endphp
                                                    {{ $grade }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $penilaian->user->dosen->nama_dosen ?? '-' }}
                                                </td>
                                                <td class="text-center">
                                                    <!-- Tombol Cetak yang baru -->
                                                    <a href="{{ route('admin.penilaianprofilematching.show', $penilaian->id) }}"
                                                        class="btn btn-sm bg-gradient-info me-2" title="Cetak">
                                                        <i class="fa fa-print" style="font-size:10px"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center text-secondary py-4">
                                                    <h6 class="mb-0">Belum ada data penilaian</h6>
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
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                const dataId = selectedDataId; // Mengambil ID data yang dipilih

                // Logika penghapusan data bisa ditambahkan di sini (misalnya melalui AJAX)
                alert("Data dengan ID " + dataId + " berhasil dihapus.");

                // Menutup modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('confirmDeleteModal'));
                modal.hide();

                // Redirect atau perbarui halaman
                window.location.href = "admin.penilaianprofilmatching.html"; // Atau sesuaikan dengan kebutuhan
            });
        </script>
    </main>
</body>

</html>
