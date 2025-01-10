<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('index') }}" class="logo d-flex align-items-center me-auto">
            <h1 class="sitename">E-Kinerja UMBJM</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <!-- Link ke beranda -->
                <li>
                    <a href="{{ route('index') }}" class="{{ Request::routeIs('index') ? 'active' : '' }}">BERANDA</a>
                </li>

                <!-- Dropdown menu -->
                <li class="dropdown">
                    <a href="#" class="{{ Request::is('*#tentangsistem') || Request::is('*#penilaian') || Request::is('*#strukturorganisasi') || Request::is('*#lokasidanpeta') ? 'active' : '' }}">
                        <span>TENTANG</span> 
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="{{ route('index') }}#tentangsistem" class="{{ Request::is('*#tentangsistem') ? 'active' : '' }}">Tentang Sistem</a></li>
                        <li><a href="{{ route('index') }}#penilaian" class="{{ Request::is('*#penilaian') ? 'active' : '' }}">Penilaian Dosen</a></li>
                        <li><a href="{{ route('index') }}#strukturorganisasi" class="{{ Request::is('*#strukturorganisasi') ? 'active' : '' }}">Struktur Organisasi</a></li>
                        <li><a href="{{ route('index') }}#lokasidanpeta" class="{{ Request::is('*#lokasidanpeta') ? 'active' : '' }}">Lokasi dan Peta</a></li>
                    </ul>
                </li>

                <!-- Link ke kontak -->
                <li><a href="{{ route('kontak') }}" class="{{ Request::routeIs('kontak') ? 'active' : '' }}">KONTAK</a></li>
            </ul>

            <!-- Mobile menu toggle -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="{{ route('masuk') }}" class="{{ Request::routeIs('masuk') ? 'active' : '' }}">MASUK</a>

    </div>
</header>