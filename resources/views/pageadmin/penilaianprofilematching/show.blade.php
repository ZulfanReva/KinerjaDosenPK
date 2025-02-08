<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Detail Penilaian | E-Kinerja UMBJM'" />

<head>
    <style>
        @media print {

            body,
            html {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100vh;
                overflow: visible;
            }

            .x-headeradmin,
            .btn,
            .x-navigasiadmin,
            .main-content> :not(.container-fluid) {
                display: none !important;
            }

            .card {
                border: none;
                box-shadow: none;
                margin: 0;
                padding: 0;
            }

            .card-body {
                padding: 15px;
                font-size: 10pt;
                line-height: 1.3;
            }

            .table-bordered {
                margin-bottom: 10px;
                font-size: 9pt;
            }

            .table-bordered td,
            .table-bordered th {
                padding: 4px 6px;
                border: 1px solid #000 !important;
            }

            h6.text-uppercase {
                font-size: 11pt;
                margin: 10px 0 5px 0;
            }

            .row {
                margin-bottom: 10px;
            }

            .row.mb-2 {
                margin-bottom: 8px;
            }

            .col-md-6 {
                width: 48%;
                float: left;
                margin-right: 2%;
            }

            ul {
                margin: 5px 0;
                padding-left: 20px;
            }

            li {
                font-size: 9pt;
                line-height: 1.3;
                margin-bottom: 2px;
            }

            .text-end {
                margin-top: 15px;
                clear: both;
            }

            .text-end p {
                margin: 3px 0;
            }

            .text-end img {
                height: 80px;
                margin: 5px 0;
            }

            @page {
                size: A4;
                margin: 1cm;
                /* Atur margin sesuai kebutuhan */
            }

            .container-fluid {
                transform-origin: top left;
                transform: scale(0.95);
            }

            img {
                max-width: 100%;
                height: auto;
            }

            .card-body {
                page-break-before: avoid;
                page-break-after: avoid;
            }

            .card-header img {
                height: 70px;
                margin-bottom: -60px;
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
                    <button class="btn bg-gradient-info" onclick="window.print()">
                        <i class="fa fa-print" style="font-size:10px"></i> Cetak
                    </button>
                </div>
            </div>

            <div class="card">
                {{-- <div class="card-header text-start">
                    <img src="{{ asset('assets/foto/kopsurat.png') }}" alt="Logo"
                        style="height: 80px; margin-bottom: -70px;">
                </div> --}}

                <!-- Logo dan Garis -->
                <div class="letterhead" style="text-align: center; margin-bottom: 5px;">
                    <img src="{{ asset('assets/foto/kopsurat.png') }}" alt="Logo">
                </div>
                

                <!-- Header Text -->
                <div class="header" style="text-align: center; margin-bottom: 10px;">
                    <h2 style="margin-bottom: -5px; font-size: 16pt;">LAPORAN PENILAIAN PERILAKU KERJA DOSEN</h2>
                    <h3 style="margin-bottom: -5px; font-size: 14pt;">UNIVERSITAS MUHAMMADIYAH BANJARMASIN</h3>
                    {{-- <h4 style="margin-bottom: -1px; font-size: 12pt;">PERIODE: {{ $periodeFilter ?? 'SEMUA PERIODE' }} --}}
                    </h4>
                </div>


                <div class="card-body">
                    <style>
                        /* CSS yang sudah ada */
                        .table-bordered {
                            border-collapse: collapse;
                            width: 100%;
                            table-layout: fixed;
                            /* Default tetap fixed */
                            margin-bottom: 10px;
                        }

                        .table-bordered th,
                        .table-bordered td {
                            border: 1px solid black !important;
                            padding: 6px;
                            text-align: left;
                            word-wrap: break-word;
                            max-width: 200px;
                            /* Batas awal default */
                            overflow-wrap: break-word;
                            /* Mencegah teks keluar batas */
                            white-space: normal;
                            /* Membantu agar teks panjang tetap dalam batas */
                        }

                        .table-bordered tr:last-child td {
                            border-bottom: 1px solid black !important;
                        }

                        .text-uppercase {
                            font-weight: bold;
                            text-transform: uppercase;
                            margin-bottom: 5px;
                        }

                        .row {
                            margin-bottom: 10px;
                            display: flex;
                            flex-wrap: wrap;
                            gap: 15px;
                        }

                        .col-md-6 {
                            flex: 1;
                            min-width: 300px;
                            max-width: calc(50% - 7.5px);
                        }

                        ul {
                            margin-top: 5px;
                            padding-left: 15px;
                        }

                        .col-md-6 h6 {
                            margin-bottom: 5px;
                        }

                        @media (max-width: 768px) {
                            .col-md-6 {
                                max-width: 100%;
                            }
                        }

                        /* Bagian kesimpulan */
                        .kesimpulan h6 {
                            margin-bottom: 0.5rem;
                            font-size: 1rem;
                        }

                        .kesimpulan ul {
                            margin-top: 0;
                            padding-left: 1.5rem;
                            list-style-type: disc;
                        }

                        /* Tambahkan CSS baru untuk font dan warna */
                        .custom-font {
                            font-family: 'Times New Roman', Times, serif;
                            font-size: 12pt;
                            color: black;
                        }

                        /* Tambahan untuk fleksibilitas tabel */
                        .custom-font td {
                            max-width: 100%;
                            min-width: 120px;
                            overflow-wrap: anywhere;
                        }

                        /* Jika kontennya lebih panjang, atur table-layout ke auto */
                        @media (min-width: 1024px) {
                            .table-bordered {
                                table-layout: auto;
                            }
                        }
                    </style>

                    <!-- Data Dosen -->
                    <div class="row mb-2 custom-font">
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-sm">Profil Dosen</h6>
                            <table class="table table-bordered custom-font">
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $penilaian->dosen->nama_dosen }}</td>
                                </tr>
                                <tr>
                                    <td>NIDN</td>
                                    <td>{{ $penilaian->dosen->nidn }}</td>
                                </tr>
                                <tr>
                                    <td>Prodi</td>
                                    <td>{{ $penilaian->dosen->prodi->nama_prodi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{ $penilaian->dosen->status ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-uppercase text-sm">Profil Dosen Penilai</h6>
                            <table class="table table-bordered custom-font">
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $penilaian->user->dosen->nama_dosen ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>{{ $penilaian->user->dosen->jabatan->nama_jabatan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Penilaian</td>
                                    <td>{{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Periode</td>
                                    <td>{{ $penilaian->periode->nama_periode ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Penilaian Perilaku Kerja -->
                    <div class="row mb-2 custom-font">
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-sm">Penilaian Perilaku Kerja</h6>
                            <table class="table table-bordered custom-font">
                                <thead>
                                    <tr>
                                        <th class="text-center">ASPEK</th>
                                        <th class="text-center">NILAI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-start">Orientasi Pelayanan</td>
                                        <td class="text-center">{{ $penilaian->orientasi_pelayanan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Integritas</td>
                                        <td class="text-center">{{ $penilaian->integritas }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Komitmen</td>
                                        <td class="text-center">{{ $penilaian->komitmen }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Disiplin</td>
                                        <td class="text-center">{{ $penilaian->disiplin }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Kerjasama</td>
                                        <td class="text-center">{{ $penilaian->kerjasama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Kepemimpinan</td>
                                        <td class="text-center">{{ $penilaian->kepemimpinan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Hasil Perhitungan -->
                        <div class="col-md-6 custom-font">
                            <h6 class="text-uppercase text-sm">Hasil Perhitungan</h6>
                            <table class="table table-bordered custom-font">
                                <tr>
                                    <td class="w-50 text-start">Total Nilai</td>
                                    <td class="text-start">{{ $penilaian->total_nilai }}</td>
                                </tr>
                                <tr>
                                    <td class="text-start">Grade</td>
                                    <td class="text-start">
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
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Kesimpulan -->
                    <div class="kesimpulan">
                        <h6 class="text-uppercase text-sm custom-font">Kesimpulan</h6>
                        <ul class="custom-font">
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
                            @foreach ($kesimpulan as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Penutupan -->
                    <div class="text-end custom-font">
                        <p>Barito Kuala, {{ date('d/m/Y') }}</p>
                        <p>Kepala Bagian SDI</p>
                        <img src="{{ asset('assets/foto/ttddigital.png') }}" alt="Tanda Tangan" style="height: 100px;">
                        <p>Bapak Wahyudin</p>
                    </div>
                </div>
            </div>

    </main>
</body>

</html>
