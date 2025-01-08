<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Form Penilaian BKD | E-Kinerja UMBJM'" />

<body class="g-sidenav-show bg-gray-100">
  <x-navigasiadmin></x-navigasiadmin>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin.penilaianpm.index') }}">Penilaian BKD</a></li>
              <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Form Penilaian BKD</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Selamat Datang di Halamanan Form Penilaian BKD</h6>
          </nav>
        </div>
    </nav>

    <div class="container-fluid mt-4">
      <div class="page-header min-height-300 border-radius-xl" style="background-image: url('{{ asset('assets/foto/bginputpk.png') }}'); background-position-y: 50%;">
        <span class="mask bg-gradient-info opacity-6"></span>
      </div>
      
      <div class="card card-body blur shadow-blur mx-4 mt-4 overflow-hidden">
        <form id="penilaian-bkd-form" method="POST" action="{{ route('admin.penilaianbkd.store') }}">
            @csrf
            <h6 class="text-center text-info mb-4 font-weight-bold">FORM PENILAIAN BEBAN KERJA DOSEN</h6>
            
            <!-- Profil Dosen -->
            <div class="row">
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
                </div>

                <div class="col-md-6">
                    <h6 class="font-weight-bold text-info">Waktu Penilaian</h6>
                    <div class="form-group">
                        <label for="periode" class="form-label">Periode</label>
                        <input type="hidden" name="periode_id" value="{{ $selectedPeriode->id }}">
                        <input type="text" class="form-control" id="periode" value="{{ $selectedPeriode ? $selectedPeriode->nama_periode : 'Belum ada periode yang dipilih' }}" readonly>
                    </div>
                </div>
            
            </div>
            
            <!-- Penilaian Beban Kerja Dosen -->
            <div class="row mt-4">
                <h6 class="font-weight-bold text-info text-center">Penilaian Beban Kerja Dosen</h6>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bidang-pendidikan">Bidang Pendidikan</label>
                        <select class="form-select" id="bidang-pendidikan" name="bidang_pendidikan" onchange="hitungNCF()">
                            <option value="">Pilih Nilai</option>
                            <option value="1">1 (Tidak Memenuhi)</option>
                            <option value="2">2 (Memenuhi)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bidang-penelitian">Bidang Penelitian</label>
                        <select class="form-select" id="bidang-penelitian" name="bidang_penelitian" onchange="hitungNCF()">
                            <option value="">Pilih Nilai</option>
                            <option value="1">1 (Tidak Memenuhi)</option>
                            <option value="2">2 (Memenuhi)</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bidang-pengabdian">Bidang Pengabdian</label>
                        <select class="form-select" id="bidang-pengabdian" name="bidang_pengabdian" onchange="hitungNCF()">
                            <option value="">Pilih Nilai</option>
                            <option value="1">1 (Tidak Memenuhi)</option>
                            <option value="2">2 (Memenuhi)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bidang-penunjang">Bidang Penunjang</label>
                        <select class="form-select" id="bidang-penunjang" name="bidang_penunjang" onchange="hitungNCF()">
                            <option value="">Pilih Nilai</option>
                            <option value="1">1 (Tidak Memenuhi)</option>
                            <option value="2">2 (Memenuhi)</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Kolom untuk Total Core Factor (NCF) -->
            <div class="row mt-4">
                <h6 class="font-weight-bold text-info text-center">Total Core Factor (NCF)</h6>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="ncf-value">Nilai NCF</label>
                        <input type="text" class="form-control" id="ncf-value" name="nilai_ncf" readonly>
                    </div>
                </div>
            </div>

            <!-- Input tersembunyi untuk nilai_ncf -->
            <input type="hidden" name="nilai_ncf" id="nilai-ncf-input">

            <div class="row mt-4">
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('admin.penilaianpm.index') }}'">Kembali</button>
                    <button type="submit" class="btn bg-gradient-info me-2">Simpan</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </main>

  <script>
    function hitungNCF() {
    const standar = { 
        "bidang-pendidikan": 2, 
        "bidang-penelitian": 1, 
        "bidang-pengabdian": 2, 
        "bidang-penunjang": 1 
    };
    const bobot = { 0: 5, "1": 4.5, "-1": 4 };

    const kriteria = [
        "bidang-pendidikan", 
        "bidang-penelitian", 
        "bidang-pengabdian", 
        "bidang-penunjang"
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

    // Jika semua dropdown terisi, hitung NCF
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

        // Hitung dan tampilkan NCF
        const ncf = totalBobot / kriteria.length;
        const ncfRounded = parseFloat(ncf.toFixed(2));
        
        document.getElementById("ncf-value").value = ncfRounded;
        document.getElementById("nilai-ncf-input").value = ncfRounded;

        return true;
    } else {
        // Kosongkan NCF jika belum semua terisi
        document.getElementById("ncf-value").value = "";
        document.getElementById("nilai-ncf-input").value = "";
        return false;
    }
}

// Tambahkan event listener ke semua dropdown untuk perhitungan real-time
document.addEventListener('DOMContentLoaded', function() {
    const kriteria = [
        "bidang-pendidikan", 
        "bidang-penelitian", 
        "bidang-pengabdian", 
        "bidang-penunjang"
    ];

    kriteria.forEach(function(id) {
        const dropdown = document.getElementById(id);
        if (dropdown) {
            dropdown.addEventListener('change', hitungNCF);
        }
    });

    // Validasi form sebelum submit
    const form = document.getElementById("penilaian-bkd-form");
    form.addEventListener("submit", function(e) {
        const kriteria = [
            "bidang-pendidikan", 
            "bidang-penelitian", 
            "bidang-pengabdian", 
            "bidang-penunjang"
        ];

        // Cek apakah semua dropdown terisi
        const semuaTerisi = kriteria.every(id => 
            document.getElementById(id).value !== ""
        );

        if (!semuaTerisi) {
            e.preventDefault();
            alert("Harap lengkapi semua penilaian Beban Kerja Dosen!");
            
            // Tandai field yang kosong
            kriteria.forEach(id => {
                const dropdown = document.getElementById(id);
                if (dropdown.value === "") {
                    dropdown.classList.add('is-invalid');
                } else {
                    dropdown.classList.remove('is-invalid');
                }
            });
            return;
        }

        // Pastikan perhitungan NCF dilakukan sebelum submit
        if (!hitungNCF()) {
            e.preventDefault();
            alert("Gagal menghitung Nilai Core Factor (NCF)!");
        }
    });
});
    
  </script>
</body>

</html>