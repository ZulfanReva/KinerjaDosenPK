<!-- Button Logout dan Guidebook -->
<ul class="navbar-nav justify-content-end">
  <li class="nav-item d-flex align-items-center">
    <!-- Tombol Guidebook -->
    <a class="btn btn-outline-info btn-sm mb-0 me-3" href="https://www.canva.com/design/DAGbhyKyk58/IaWCzIV97DX2k1qvqMXWjw/edit?utm_content=DAGbhyKyk58&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton" target="_blank">
      Guidebook
    </a>

    <!-- Tombol Keluar -->
    <a class="btn btn-outline-primary btn-sm mb-0 me-3" data-bs-toggle="modal" data-bs-target="#logoutModal">Keluar</a>

    <!-- Modal Konfirmasi Keluar -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Keluar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin keluar dari akun?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            
            <!-- Form logout -->
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn bg-gradient-info">Keluar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </li>
</ul>