<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('dosenberjabatan.beranda') }}">
            <img src="{{ asset('assets/foto/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">E-Kinerja UMBJM</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Section Utama -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Utama</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dosenberjabatan.beranda') ? 'active' : '' }}" href="{{ route('dosenberjabatan.beranda') }}">
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
                <a class="nav-link {{ request()->routeIs('dosenberjabatan.penilaianperilakukerja*') ? 'active' : '' }}" href="{{ route('dosenberjabatan.penilaianperilakukerja.index') }}">
                    <div class="bg-gradient-info icon-shape shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/foto/pm.png') }}" alt="Penilaian PK" width="50" height="50">
                    </div>
                    <span class="nav-link-text ms-1">Penilaian</span>
                </a>
            </li>
            
            <!-- Section Akun -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Akun</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dosenberjabatan.profil.index') ? 'active' : '' }}" href="{{ route('dosenberjabatan.profil.index') }}">
                    <div class="bg-gradient-info icon-shape shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/foto/profil.png') }}" alt="Profil dosenberjabatan" width="50" height="50">
                    </div>
                    <span class="nav-link-text ms-1">Profil</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidenav-footer mx-3">
        <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
            <div class="full-background bg-gradient-info"></div>
            <div class="card-body text-start p-3 w-100">
                <div class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
                    <img src="{{ asset('assets/foto/LogoWA.png') }}" alt="Logo WhatsApp" class="img-fluid" style="max-width: 30px; max-height: 30px;">
                </div>
                <div class="docs-info">
                    <h6 class="text-white up mb-0">Butuh Bantuan?</h6>
                    <p class="text-xs font-weight-bold">Silahkan hubungi admin</p>
                    <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard" target="_blank" class="btn btn-white btn-sm w-100 mb-0 bg-gradient-info">Whats App Admin</a>
                </div>
            </div>
        </div>
        <!-- Button untuk Mode Malam -->
        <button id="modeToggle" class="btn bg-gradient-primary mt-3 w-100 bg-gradient-info">Mode Malam</button>
        <x-modemalam></x-modemalam>
    </div>    
</aside>