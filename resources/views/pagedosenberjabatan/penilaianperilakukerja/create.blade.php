<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Form Penilaian PK | E-Kinerja UMBJM'" />

<body class="g-sidenav-show  bg-gray-100">
    <x-navigasidosenberjabatan></x-navigasidosenberjabatan>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                href="{{ route('dosenberjabatan.penilaianperilakukerja.index') }}">Penilaian Perilaku
                                Kerja</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Form Penilaian</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Selamat Datang di Halamanan Form Penilaian Perilaku Kerja</h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            <div class="container-fluid">
                <div class="page-header min-height-300 border-radius-xl mt-4"
                    style="background-image: url('{{ asset('assets/foto/bginputpk.png') }}'); background-position-y: 50%;">
                    <span class="mask bg-gradient-info opacity-6"></span>
                </div>

                <div class="card card-body blur shadow-blur mx-4 mt-4 overflow-hidden">
                    <form id="penilaian-pk-form" method="POST"
                        action="{{ route('dosenberjabatan.penilaianperilakukerja.store') }}">
                        @csrf
                        <h6 class="text-center text-info mb-4 font-weight-bold">FORM PENILAIAN PERILAKU KERJA</h6>

                        <div class="row">
                            <!-- Profil Dosen -->
                            <div class="col-md-6">
                                <h6 class="font-weight-bold text-info">Profil Dosen</h6>
                                <div class="form-group">
                                    <label for="nama-dosen">Nama</label>
                                    <input type="text" class="form-control" id="nama-dosen"
                                        value="{{ $dosen->nama_dosen }}" readonly>
                                    <input type="hidden" name="dosen_id" value="{{ $dosen->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="nidn">NIDN</label>
                                    <input type="text" class="form-control" id="nidn"
                                        value="{{ $dosen->nidn }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="prodi">Prodi</label>
                                    <input type="text" class="form-control" id="prodi"
                                        value="{{ $dosen->prodi->nama_prodi }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status"
                                        value="{{ $dosen->status }}" readonly>
                                </div>
                            </div>

                            <!-- Profil Dosen Berjabatan -->
                            <div class="col-md-6">
                                <h6 class="font-weight-bold text-info">Profil Dosen Berjabatan</h6>
                                <div class="form-group">
                                    <label for="nama-user">Nama Dosen Berjabatan</label>
                                    <input type="text" class="form-control" id="nama-user"
                                        value="{{ $dosenBerjabatan->nama_dosen }}" readonly>
                                    <input type="hidden" name="user_id" value="{{ $dosenBerjabatan->users_id }}">
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan"
                                        value="{{ $dosenBerjabatan->jabatan->nama_jabatan ?? 'Belum Ditentukan' }}"
                                        readonly>
                                </div>

                                <h6 class="font-weight-bold text-info">Waktu Penilaian</h6>
                                <div class="form-group">
                                    <label for="periode" class="form-label">Periode</label>
                                    <select name="periode" class="form-select" required>
                                        <option value="" selected disabled>Pilih Periode</option>
                                        @foreach ($periodeList as $periode)
                                            <option value="{{ $periode }}">{{ $periode }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <h6 class="font-weight-bold text-info text-center">Penilaian Perilaku Kerja</h6>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="integritas">Integritas</label>
                                    <select class="form-select" id="integritas" name="integritas">
                                        <option value="">Pilih Nilai</option>
                                        <option value="1">1 (Tidak Memenuhi Syarat)</option>
                                        <option value="2">2 (Kurang Baik)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Sangat Baik)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="komitmen">Komitmen</label>
                                    <select class="form-select" id="komitmen" name="komitmen">
                                        <option value="">Pilih Nilai</option>
                                        <option value="1">1 (Tidak Memenuhi Syarat)</option>
                                        <option value="2">2 (Kurang Baik)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Sangat Baik)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kerjasama">Kerjasama</label>
                                    <select class="form-select" id="kerjasama" name="kerjasama">
                                        <option value="">Pilih Nilai</option>
                                        <option value="1">1 (Tidak Memenuhi Syarat)</option>
                                        <option value="2">2 (Kurang Baik)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Sangat Baik)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="orientasi-pelayanan">Orientasi Pelayanan</label>
                                    <select class="form-select" id="orientasi-pelayanan" name="orientasi_pelayanan">
                                        <option value="">Pilih Nilai</option>
                                        <option value="1">1 (Tidak Memenuhi Syarat)</option>
                                        <option value="2">2 (Kurang Baik)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Sangat Baik)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="disiplin">Disiplin</label>
                                    <select class="form-select" id="disiplin" name="disiplin">
                                        <option value="">Pilih Nilai</option>
                                        <option value="1">1 (Tidak Memenuhi Syarat)</option>
                                        <option value="2">2 (Kurang Baik)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Sangat Baik)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kepemimpinan">Kepemimpinan</label>
                                    <select class="form-select" id="kepemimpinan" name="kepemimpinan">
                                        <option value="">Pilih Nilai</option>
                                        <option value="1">1 (Tidak Memenuhi Syarat)</option>
                                        <option value="2">2 (Kurang Baik)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Sangat Baik)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom untuk Total Nilai Perhitungan Core Factor dan Secondary Factor -->
                        <div class="row mt-4">
                            <h6 class="font-weight-bold text-info text-center">Hasil Perhitungan Core Factor dan
                                Secondary Factor</h6>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="core-factor-value">Nilai Core Factor</label>
                                    <input type="text" class="form-control" id="core-factor-value"
                                        name="nilai_corefactor" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="secondary-factor-value">Nilai Secondary Factor</label>
                                    <input type="text" class="form-control" id="secondary-factor-value"
                                        name="nilai_secondaryfactor" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="window.location.href='{{ route('dosenberjabatan.penilaianperilakukerja.index') }}'">Kembali</button>
                                <button type="submit" class="btn bg-gradient-info me-2">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function hitungFaktor() {
            // Standar nilai
            const standar = 4;

            // Core Factor dan Secondary Factor
            const coreFactorKriteria = ["integritas", "komitmen", "kerjasama"];
            const secondaryFactorKriteria = ["orientasi-pelayanan", "disiplin", "kepemimpinan"];

            let coreTotal = 0;
            let secondaryTotal = 0;
            let coreTerisi = true;
            let secondaryTerisi = true;

            // Hitung Core Factor
            coreFactorKriteria.forEach(id => {
                const element = document.getElementById(id);
                const value = parseInt(element.value);
                if (isNaN(value)) {
                    coreTerisi = false;
                } else {
                    coreTotal += value - standar;
                }
            });

            // Hitung Secondary Factor
            secondaryFactorKriteria.forEach(id => {
                const element = document.getElementById(id);
                const value = parseInt(element.value);
                if (isNaN(value)) {
                    secondaryTerisi = false;
                } else {
                    secondaryTotal += value - standar;
                }
            });

            // Isi kolom Core Factor jika semua terisi
            if (coreTerisi) {
                const coreFactor = coreTotal / coreFactorKriteria.length + 4;
                document.getElementById("core-factor-value").value = coreFactor.toFixed(2);
            } else {
                document.getElementById("core-factor-value").value = "";
            }

            // Isi kolom Secondary Factor jika semua terisi
            if (secondaryTerisi) {
                const secondaryFactor = secondaryTotal / secondaryFactorKriteria.length + 4;
                document.getElementById("secondary-factor-value").value = secondaryFactor.toFixed(2);
            } else {
                document.getElementById("secondary-factor-value").value = "";
            }
        }

        // Tambahkan event listener ke semua dropdown
        document.addEventListener("DOMContentLoaded", function() {
            const kriteria = ["integritas", "komitmen", "kerjasama", "orientasi-pelayanan", "disiplin",
                "kepemimpinan"
            ];
            kriteria.forEach(id => {
                const dropdown = document.getElementById(id);
                if (dropdown) {
                    dropdown.addEventListener("change", hitungFaktor);
                }
            });
        });
    </script>

</body>

</html>
