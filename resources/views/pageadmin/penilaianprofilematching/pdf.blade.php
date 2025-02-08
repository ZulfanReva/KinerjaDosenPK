<!-- resources/views/pageadmin/penilaianprofilematching/pdf.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penilaian Perilaku Kerja</title>
    <style>
        body {
            font-family: 'Times New Roman';
            font-size: 12px;
            color: black;
        }

        .letterhead {
            text-align: center;
            margin-bottom: 30px;
        }

        .letterhead img {
            height: 80px;
            display: block;
            margin: 0 auto 10px auto;
        }

        .letterhead hr {
            border: 1px solid black;
            margin: 0 0 30px 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2,
        .header h3 {
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 11px;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            padding: 10px 0;
        }

        .export-info {
            text-align: center;
            font-size: 10px;
            margin-bottom: 10px;
        }

        .signature {
            margin-top: 30px;
            text-align: right;
            padding-right: 50px;
        }

        .signature p {
            margin: 5px 0;
        }

        .signature img {
            height: 100px;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <!-- Logo dan Garis -->
    <div class="letterhead" style="margin-bottom: -10px;">
        <img src="{{ $kopBase64 }}" alt="Logo">
        <hr>
    </div>

    <!-- Header Text -->
    <div class="header" style="margin-bottom: 10px;">
        <h2 style="margin-bottom: -5px;">REKAP PENILAIAN PERILAKU KERJA DOSEN</h2>
        <h3 style="margin-bottom: -5px;">UNIVERSITAS MUHAMMADIYAH BANJARMASIN</h3>
        <h4 style="margin-bottom: -1-px;">PERIODE: {{ $periodeFilter ?? 'SEMUA PERIODE' }}</h4>
    </div>


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dosen</th>
                <th>NIDN</th>
                <th>Prodi</th>
                <th>Periode</th>
                <th>Tanggal Penilaian</th>
                <th>Nilai</th>
                <th>Grade</th>
                <th>Dosen Penilai</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nomorUrut = 1; // Anda bisa mengubah nilai ini sesuai keinginan
            @endphp
            @forelse($penilaianPerilaku as $penilaian)
                <tr>
                    <td>{{ $nomorUrut++ }}</td> <!-- Menampilkan nomor urut manual -->
                    <td>{{ $penilaian->dosen->nama_dosen }}</td>
                    <td>{{ $penilaian->dosen->nidn }}</td>
                    <td>{{ $penilaian->dosen->prodi->nama_prodi ?? '-' }}</td>
                    <td>{{ $penilaian->periode->nama_periode ?? '-' }}</td>
                    <td>{{ Carbon\Carbon::parse($penilaian->tanggal_penilaian)->format('d-m-Y') }}</td>
                    <td>{{ $penilaian->total_nilai }}</td>
                    <td>{{ $penilaian->grade }}</td>
                    <td>{{ $penilaian->user->dosen->nama_dosen ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Tidak ada data penilaian</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature">
        <p>Barito Kuala, {{ date('d/m/Y') }}</p>
        <p>Kepala Bagian SDI</p>
        <img src="{{ $ttdBase64 }}" alt="Tanda Tangan">
        <p>Bapak Wahyudin</p>
    </div>

    <div class="footer export-info" style="color: grey">
        E-Kinerja UMBJM - Laporan Penilaian Perilaku Kerja<br>
        Tanggal Export: {{ $exportDate }}
    </div>

</body>

</html>
