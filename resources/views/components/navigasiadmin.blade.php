<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('admin.beranda') }}">
            <img src="{{ asset('assets/foto/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">E-Kinerja UMBJM</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto custom-scrollbar" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Section Utama -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Utama</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.beranda') ? 'active' : '' }}" href="{{ route('admin.beranda') }}">
                    <div class="bg-gradient-info icon-shape shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/foto/dashboard.png') }}" alt="Dashboard" width="50" height="50">
                    </div>
                    <span class="nav-link-text ms-1">Beranda</span>
                </a>
            </li>

            <!-- Section Halaman -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Halaman</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.datadosen*') ? 'active' : '' }}" href="{{ route('admin.datadosen.index') }}">
                    <div class="bg-gradient-info icon-shape shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/foto/dosenaktif.png') }}" alt="Data Dosen" width="50" height="50">
                    </div>
                    <span class="nav-link-text ms-1">Data Dosen</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dataprodi*') ? 'active' : '' }}" href="{{ route('admin.dataprodi.index') }}">
                    <div class="bg-gradient-info icon-shape shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/foto/prodi.png') }}" alt="Data Prodi" width="50" height="50">
                    </div>
                    <span class="nav-link-text ms-1">Data Prodi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.datajabatan*') ? 'active' : '' }}" href="{{ route('admin.datajabatan.index') }}">
                    <div class="bg-gradient-info icon-shape shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/foto/jabatan.png') }}" alt="Data Jabatan" width="50" height="50">
                    </div>
                    <span class="nav-link-text ms-1">Data Jabatan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.penilaianpm*') ? 'active' : '' }}" href="{{ route('admin.penilaianpm.index') }}">            
                    <div class="bg-gradient-info icon-shape shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/foto/pm.png') }}" alt="Penilaian PM" width="50" height="50">
                    </div>
                    <span class="nav-link-text ms-1">Penilaian</span>
                </a>
            </li>
            
            <!-- Section Akun -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Akun</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.profiladmin') ? 'active' : '' }}" href="{{ route('admin.profiladmin') }}">
                    <div class="bg-gradient-info icon-shape shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/foto/profil.png') }}" alt="Profil Admin" width="50" height="50">
                    </div>
                    <span class="nav-link-text ms-1">Profil</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
        <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
          <div class="full-background bg-gradient-info" ></div>
          <div class="card-body text-start p-3 w-100">
            <div class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
                <img src="{{ asset('assets/foto/LogoWA.png') }}" alt="Logo WhatsApp" class="img-fluid" style="max-width: 30px; max-height: 30px;">
            </div>
            <div class="docs-info">
              <h6 class="text-white up mb-0">Butuh Bantuan?</h6>
              <p class="text-xs font-weight-bold">Silahkan kontak dibawah ini</p>
              <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard" target="_blank" class="btn btn-white btn-sm w-100 mb-0 bg-gradient-info">WA Super Admin</a>
            </div>
          </div>
        </div>
        <a class="btn bg-gradient-primary mt-3 w-100 bg-gradient-info">PENGATURAN</a>
      </div>
</aside>

<style>
    /* Membatasi tinggi sidebar dan menambahkan fitur scroll */
    .custom-scrollbar {
        max-height: calc(100vh - 120px); /* Sesuaikan dengan tinggi header */
        overflow-y: hidden; /* Sembunyikan scrollbar saat tidak di-hover */
        transition: overflow 0.3s ease-in-out;
    }

    /* Menampilkan scrollbar saat hover */
    .custom-scrollbar:hover {
        overflow-y: auto; /* Scroll muncul saat hover */
    }

    /* Mengkustomisasi tampilan scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background-color: transparent;
    }
</style>
