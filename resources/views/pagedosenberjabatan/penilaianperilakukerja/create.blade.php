<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Form Penilaian PK | E-Kinerja UMBJM'" />

<body class="g-sidenav-show  bg-gray-100">
  <x-navigasidosenberjabatan></x-navigasidosenberjabatan>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dosenberjabatan.penilaianpk.index') }}">Penilaian PK</a></li>
              <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Form Penilaian</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Selamat Datang di Halamanan Form Penilaian PK</h6>
          </nav>
        </div>
      </nav>
      <!-- End Navbar -->

    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
      <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{ asset('assets/foto/bginputpk.png') }}'); background-position-y: 50%;">
          <span class="mask bg-gradient-info opacity-6"></span>
        </div>
        
        <div class="card card-body blur shadow-blur mx-4 mt-4 overflow-hidden">
            <form id="penilaian-pk-form" method="POST" action="{{ route('dosenberjabatan.penilaianpk.store') }}">
                @csrf
                <h6 class="text-center text-info mb-4 font-weight-bold">FORM PENILAIAN PERILAKU KERJA</h6>
                
                <div class="row">
                    <!-- Profil Dosen dan dosenberjabatan -->
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-info">Profil Dosen</h6>
                        <div class="form-group">
                            <label for="nama-dosen">Nama</label>
                            <input type="text" class="form-control" id="nama-dosen" value="{{ $dosen->nama_dosen }}" readonly>
                            <input type="hidden" name="dosen_id" value="{{ $dosen->id }}">
                        </div>
                        <div class="form-group">
                            <label for="nidn">NIDN</label>
                            <input type="text" class="form-control" id="nidn" value="{{ $dosen->nidn }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Prodi</label>
                            <input type="text" class="form-control" id="prodi" value="{{ $dosen->prodi->nama_prodi }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" value="{{ $dosen->status }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-info">Profil dosenberjabatan</h6>
                        <div class="form-group">
                            <label for="nama-dosenberjabatan">Nama</label>
                            <input type="text" class="form-control" id="nama-dosenberjabatan" value="{{ $dosenberjabatan->nama_dosenberjabatan }}" readonly>
                            <input type="hidden" name="dosenberjabatan_id" value="{{ $dosenberjabatan->id }}">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" value="{{ $dosenberjabatan->jabatan->nama_jabatan }}" readonly>
                        </div>

                        <h6 class="font-weight-bold text-info">Waktu Penilaian</h6>
                        <div class="form-group">
                        <label for="periode" class="form-label">Periode</label>
                        <select name="periode_id" class="form-select" required>
                            <option value="" selected disabled>Pilih Periode</option>
                            @foreach ($periodeList as $periode)
                                <option value="{{ $periode->id }}">{{ $periode->nama_periode }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                </div>  
                
                <div class="row mt-4">
                    <h6 class="font-weight-bold text-info text-center">Penilaian Perilaku Kerja</h6>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="orientasi-pelayanan">Orientasi Pelayanan</label>
                            <select class="form-select" id="orientasi-pelayanan" name="orientasi_pelayanan" onchange="hitungNSF()">
                                <option value="">Pilih Nilai</option>
                                <option value="1">1 (Tidak Memenuhi Syarat)</option>
                                <option value="2">2 (Kurang Baik) </option>
                                <option value="3">3 (Cukup)</option>
                                <option value="4">4 (Baik)</option>
                                <option value="5">5 (Sangat Baik)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="integritas">Integritas</label>
                            <select class="form-select" id="integritas" name="integritas" onchange="hitungNSF()">
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
                            <select class="form-select" id="komitmen" name="komitmen" onchange="hitungNSF()">
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
                            <label for="disiplin">Disiplin</label>
                            <select class="form-select" id="disiplin" name="disiplin" onchange="hitungNSF()">
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
                            <select class="form-select" id="kerjasama" name="kerjasama" onchange="hitungNSF()">
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
                            <select class="form-select" id="kepemimpinan" name="kepemimpinan" onchange="hitungNSF()">
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
                
                <!-- Kolom untuk Total Secondary Factor (NSF) -->
                <div class="row mt-4">
                    <h6 class="font-weight-bold text-info text-center">Total Secondary Factor (NSF)</h6>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nsf-value">Nilai NSF</label>
                            <input type="text" class="form-control" id="nsf-value" name="nilai_nsf" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                <div class="col-12 text-end"> <!-- Menggunakan text-end untuk memposisikan di kanan -->
                    <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('dosenberjabatan.penilaianpk.index') }}'">Kembali</button>
                    <button type="submit" class="btn bg-gradient-info me-2">Simpan</button>
                </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </main>

  <script>
    function hitungNSF() {
    // Definisi standar nilai untuk setiap kriteria
    const standar = {
        "orientasi-pelayanan": 3,
        "integritas": 4,
        "komitmen": 4,
        "disiplin": 3,
        "kerjasama": 3,
        "kepemimpinan": 3
    };

    // Bobot nilai berdasarkan selisih (GAP)
    const bobot = {
        0: 5,   // Tidak ada selisih
        1: 4.5, // Kelebihan 1 tingkat
        "-1": 4,  // Kekurangan 1 tingkat
        2: 3.5, // Kelebihan 2 tingkat
        "-2": 3,  // Kekurangan 2 tingkat
        3: 2.5, // Kelebihan 3 tingkat
        "-3": 2,  // Kekurangan 3 tingkat
        4: 1.5, // Kelebihan 4 tingkat
        "-4": 1   // Kekurangan 4 tingkat
    };

    const kriteria = [
        "orientasi-pelayanan", 
        "integritas", 
        "komitmen", 
        "disiplin", 
        "kerjasama", 
        "kepemimpinan"
    ];

    let totalBobot = 0;
    let semuaTerisi = true;

    // Cek apakah semua dropdown sudah dipilih
    for (const key of kriteria) {
        const nilaiElement = document.getElementById(key);
        if (!nilaiElement || nilaiElement.value === "") {
            semuaTerisi = false;
            break;
        }
    }

    // Jika semua dropdown terisi, hitung NSF
    if (semuaTerisi) {
        for (const key of kriteria) {
            const nilaiElement = document.getElementById(key);
            const nilaiInt = parseInt(nilaiElement.value);
            const gap = nilaiInt - standar[key];

            // Pastikan gap ada dalam bobot
            if (bobot[gap] !== undefined) {
                totalBobot += bobot[gap];
            }
        }

        // Hitung dan tampilkan NSF
        const nsf = totalBobot / kriteria.length;
        document.getElementById("nsf-value").value = parseFloat(nsf.toFixed(2));

    } else {
        // Kosongkan NSF jika belum semua terisi
        document.getElementById("nsf-value").value = "";
    }
}

// Tambahkan event listener ke semua dropdown
document.addEventListener('DOMContentLoaded', function() {
    const kriteria = [
        "orientasi-pelayanan", 
        "integritas", 
        "komitmen", 
        "disiplin", 
        "kerjasama", 
        "kepemimpinan"
    ];

    kriteria.forEach(function(id) {
        const dropdown = document.getElementById(id);
        if (dropdown) {
            dropdown.addEventListener('change', hitungNSF);
        }
    });
});
  </script>

  <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Seleksi form
        const form = document.querySelector('form');

        // Event listener untuk form submission
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah submit default

            // Validasi periode
            const periodeSelect = document.querySelector('select[name="periode_id"]');
            if (!periodeSelect.value) {
                alert('Silakan pilih Periode terlebih dahulu!');
                return;
            }

            // Validasi penilaian perilaku kerja
            const kriteria = [
                'orientasi-pelayanan', 'integritas', 'komitmen', 
                'disiplin', 'kerjasama', 'kepemimpinan'
            ];

            // Cek apakah semua kriteria sudah dinilai
            const semuaTerisi = kriteria.every(id => {
                const dropdown = document.getElementById(id);
                return dropdown.value !== "";
            });

            if (!semuaTerisi) {
                alert('Harap lengkapi semua penilaian perilaku kerja!');
                kriteria.forEach(id => {
                    const dropdown = document.getElementById(id);
                    if (dropdown.value === "") {
                        dropdown.classList.add('is-invalid'); // Add a class to highlight the empty field
                    } else {
                        dropdown.classList.remove('is-invalid'); // Remove the class if filled
                    }
                });
                return;
            }

            // Ambil nilai NSF
            const nsfValue = document.getElementById('nsf-value').value;
            if (!nsfValue) {
                alert('Terjadi kesalahan dalam menghitung NSF. Pastikan semua penilaian terisi.');
                return;
            }

            // Siapkan data untuk dikirim
            const formData = new FormData(form);
            
            // Tambahkan nilai NSF ke form data
            formData.append('nilai_nsf', nsfValue);

            // Kirim data ke server
            fetch("{{ route('dosenberjabatan.penilaianpk.store') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(formData),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal menyimpan data');
                }
                return response.json();
            })
            .then(data => {
                alert("Penilaian Perilaku Kerja berhasil disimpan!");
                window.location.href = "{{ route('dosenberjabatan.penilaianpk.index') }}";
            })
            .catch(error => {
                console.error("Error:", error);
                alert(`Gagal menyimpan data: ${error.message}`);
            });
    });
  </script>

</body>

</html>