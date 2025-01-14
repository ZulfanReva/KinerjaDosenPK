<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Detail Penilaian | E-Kinerja UMBJM'" />

<head>
    <style>
        /* Mengatur tampilan hanya untuk print */
        /* Mengatur tampilan hanya untuk print */
        @media print {

            body,
            html {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            body * {
                visibility: visible;
            }

            /* Menghapus tampilan card (tanpa menghapus kop surat) */
            .card {
                border: none;
                box-shadow: none;
                margin-bottom: 20px;
                /* Menambahkan margin agar ruang antar card cukup */
            }

            .card-header,
            .card-body {
                visibility: visible;
            }

            /* Menyembunyikan elemen non-essential seperti navigasi dan tombol */
            .x-headeradmin,
            .btn {
                display: none;
            }

            /* Penyesuaian untuk ukuran dan layout konten cetakan */
            .container-fluid {
                font-size: 10px;
                /* Ukuran font lebih kecil agar lebih banyak konten yang muat */
                line-height: 1.4;
            }

            /* Menyesuaikan dua kolom profil dosen dan pengawas */
            .row.mb-4 {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: space-between;
            }

            .col-md-6 {
                width: 48%;
                /* Mengatur lebar kolom lebih pas */
                padding: 10px;
            }

            /* Penyesuaian untuk elemen penilaian perilaku kerja */
            .col-md-4 {
                width: 32%;
                /* Mengatur lebar kolom lebih pas */
                padding: 10px;
            }

            /* Mengatur label dan teks di dalam form dan penilaian */
            .d-flex {
                margin-bottom: 5px;
            }

            .form-label,
            p {
                font-size: 10px;
                margin-bottom: 3px;
            }

            /* Sembunyikan tombol cetak dan kembali saat mencetak */
            .btn {
                display: none;
            }

            /* Penyesuaian posisi dan ukuran elemen penilaian */
            .d-flex.align-items-center {
                align-items: flex-start;
            }

            .d-flex .form-label {
                width: 45%;
            }

            .d-flex p {
                margin-left: 10px;
                margin-bottom: 0;
            }

            /* Penutupan dan tanda tangan */
            .text-end {
                text-align: right;
                margin-top: 30px;
            }

            /* Mengatur gambar untuk cetakan */
            img {
                max-width: 100%;
                height: auto;
            }

            /* Penyesuaian untuk hasil perhitungan */
            .col-md-6.mb-2 {
                width: 48%;
                padding: 10px;
            }
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <x-navigasiadmin></x-navigasiadmin>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Header -->
        <div class="container-fluid py-4">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <div>
                    <button class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
                    <button class="btn bg-gradient-info" onclick="window.print()">Cetak</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header text-start">
                    <img src="{{ asset('assets/foto/kopsurat.png') }}" alt="Logo" style="height: 80px;">
                    <hr style="color: black">
                </div>

                <div class="card-body p-4">
                    <!-- Data Dosen -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-sm">Profil Dosen</h6>
                            <div class="d-flex mb-2">
                                <label class="form-label w-25">Nama</label>
                                <p class="ms-3 mb-0">{{ $penilaian->dosen->nama_dosen }}</p>
                            </div>
                            <div class="d-flex mb-2">
                                <label class="form-label w-25">NIDN</label>
                                <p class="ms-3 mb-0">{{ $penilaian->dosen->nidn }}</p>
                            </div>
                            <div class="d-flex mb-2">
                                <label class="form-label w-25">Prodi</label>
                                <p class="ms-3 mb-0">{{ $penilaian->dosen->prodi->nama_prodi ?? '-' }}</p>
                            </div>
                            <div class="d-flex mb-2">
                                <label class="form-label w-25">Status</label>
                                <p class="ms-3 mb-0">{{ $penilaian->dosen->status }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-uppercase text-sm">Profil Pengawas</h6>
                            <div class="d-flex mb-2">
                                <label class="form-label w-25">Nama</label>
                                <p class="ms-3 mb-0">{{ $penilaian->user->dosen->nama_dosen ?? '-' }}</p>
                            </div>
                            <div class="d-flex mb-2">
                                <label class="form-label w-25">Jabatan</label>
                                <p class="ms-3 mb-0">{{ $penilaian->user->dosen->jabatan->nama_jabatan ?? '-' }}</p>
                            </div>

                            <h6 class="text-uppercase text-sm">Waku Penilaian</h6>
                            <div class="d-flex mb-2">
                                <label class="form-label w-25">Periode</label>
                                <p class="ms-3">{{ $penilaian->periode }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Penilaian Perilaku Kerja -->
                    <div class="row mb-4">
                        <h6 class="text-uppercase text-sm">Penilaian Perilaku Kerja</h6>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center mb-2">
                                <label class="form-label w-50">Orientasi Pelayanan</label>
                                <p class="ms-3 mb-0">{{ $penilaian->orientasi_pelayanan}}</p>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <label class="form-label w-50">Integritas</label>
                                <p class="ms-3 mb-0">{{ $penilaian->integritas}}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex align-items-center mb-2">
                                <label class="form-label w-50">Komitmen</label>
                                <p class="ms-3 mb-0">{{ $penilaian->komitmen}}</p>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <label class="form-label w-50">Disiplin</label>
                                <p class="ms-3 mb-0">{{ $penilaian->disiplin}}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex align-items-center mb-2">
                                <label class="form-label w-50">Kerjasama</label>
                                <p class="ms-3 mb-0">{{ $penilaian->kerjasama}}</p>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <label class="form-label w-50">Kepemimpinan</label>
                                <p class="ms-3 mb-0">{{ $penilaian->kepemimpinan}}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Perhitungan -->
                    <div class="row mb-4">
                        <h6 class="text-uppercase text-sm">Hasil Perhitungan</h6>
                        <div class="col-md-6 mb-2">
                            <div class="d-flex align-items-start">
                                <label class="form-label w-25">Total Nilai</label>
                                <p class="ms-3 mb-0">{{ $penilaian->total_nilai }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="d-flex align-items-start">
                                <label class="form-label w-25">Grade</label>
                                <p class="ms-3 mb-0">
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
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Kesimpulan -->
                    <div class="row mb-4">
                        <h6 class="text-uppercase text-sm mb-3">Kesimpulan</h6>
                        <div class="col-md-12">
                            @php
                                $kesimpulan = [];
                                if ($grade === 'A') {
                                    $kesimpulan = [
                                        'Pujian dalam forum rapat resmi',
                                        'Ucapan terima kasih secara formal',
                                        'Sertifikat keberhasilan',
                                        'Piagam penghargaan',
                                        'Hadiah',
                                        'Peningkatan fasilitas',
                                        'Tugas belajar atau studi lanjut (di dalam/luar negeri) atas biaya universitas',
                                        'Loncat jabatan fungsional atau kenaikan pangkat istimewa',
                                        'Publikasi atas biaya universitas',
                                    ];
                                } elseif ($grade === 'B') {
                                    $kesimpulan = [
                                        'Pujian dalam forum rapat resmi',
                                        'Ucapan terima kasih secara formal',
                                        'Sertifikat keberhasilan',
                                        'Peningkatan fasilitas',
                                        'Pembebasan SPP untuk pendidikan lanjutan',
                                        'Tugas belajar (tergantung keputusan universitas)',
                                    ];
                                } elseif ($grade === 'C') {
                                    $kesimpulan = [
                                        'Pujian dalam forum rapat resmi (hanya jika dianggap cukup memadai)',
                                        'Teguran lisan (jika dianggap perlu perbaikan)',
                                        'Teguran tertulis (untuk dorongan peningkatan kinerja ke depannya)',
                                    ];
                                } elseif ($grade === 'D') {
                                    $kesimpulan = [
                                        'Teguran lisan atau tertulis',
                                        'Peringatan keras',
                                        'Penundaan kenaikan gaji berkala',
                                        'Penundaan kenaikan pangkat',
                                    ];
                                } else {
                                    $kesimpulan = [
                                        'Peringatan keras',
                                        'Pembebasan tugas',
                                        'Penundaan kenaikan gaji berkala',
                                        'Penundaan kenaikan pangkat',
                                        'Pemberhentian jika tidak ada perbaikan signifikan',
                                    ];
                                }
                            @endphp
                            <ul>
                                @foreach ($kesimpulan as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Penutupan dan tanda tangan -->
                    <div class="text-end mt-4">
                        <p>Barito Kuala, {{ date('d/m/Y') }}</p>
                        <p>Kepala Bagian SDI</p>
                        <img src="{{ asset('assets/foto/ttddigital.png') }}" alt="Tanda Tangan" style="height: 100px;">
                        <p>Bapak Wahyudin</p>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>

</html>
