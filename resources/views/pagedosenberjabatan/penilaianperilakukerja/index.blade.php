<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Penialain Perilaku Kerja | E-Kinerja UMBJM'" />

<body class="g-sidenav-show  bg-gray-100">
    <x-navigasidosenberjabatan></x-navigasidosenberjabatan>
    <x-modemalam></x-modemalam>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                href="javascript:;">Halaman</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Penilaian Perilaku
                            Kerja</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Selamat datang di halaman Penilaian Perilaku Kerja</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar"></div>

                <!-- Button Logout -->
                <x-buttonlogout></x-buttonlogout>

            </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Menampilkan pesan sukses atau error -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @endif

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Tabel Penilaian Dosen</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                              <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Nama</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-start">NIDN</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Prodi</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dosenaktif as $dosen)
                                        <tr>
                                            <td class="text-start">
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $dosen->nama_dosen }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-start">
                                                <p class="text-xs font-weight-bold mb-0">{{ $dosen->nidn }}</p>
                                            </td>
                                            <td class="text-start">
                                                <p class="text-xs font-weight-bold mb-0">{{ $dosen->prodi->nama_prodi }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge bg-gradient-success btn-sm mb-0">Aktif</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @php
                                                    // Cek apakah dosen sudah pernah dinilai oleh dosen dengan jabatan tertentu
                                                    $isRated = $penilaianPerilakuKerjas->where('dosen_id', $dosen->id)->first();
                                                @endphp
                                                @if ($isRated)
                                                    <button class="btn bg-gradient-success btn-sm mb-0" disabled>
                                                        Sudah Dinilai
                                                    </button>
                                                @else
                                                    <a class="badge bg-gradient-danger btn-sm mb-0" href="{{ route('dosenberjabatan.penilaianperilakukerja.create', ['dosen_id' => $dosen->id]) }}">
                                                        Nilai
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-secondary py-4">
                                                <h6 class="mb-0">BELUM ADA DATA PENILAIAN PERILAKU KERJA</h6>
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

        <!-- Footer -->
        <footer class="footer pt-3">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            created by <a href="#" class="font-weight-bold" target="_blank">Universitas
                                Muhammadiyah Banjarmasin</a>.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        </div>
    </main>
</body>

</html>
