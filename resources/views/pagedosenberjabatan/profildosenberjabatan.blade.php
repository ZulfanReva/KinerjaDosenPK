<!DOCTYPE html>
<html lang="en">

<x-headeradmin :title="'Profil | E-Kinerja UMBJM'" />

<body class="g-sidenav-show bg-gray-100">
    <x-navigasidosenberjabatan></x-navigasidosenberjabatan>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                href="javascript:;">Halaman</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profil</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Selamat Datang di halaman Profil</h6>
                </nav>

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
                    <x-buttonlogout></x-buttonlogout>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            <div class="container-fluid">
                <div class="page-header min-height-300 border-radius-xl mt-4"
                    style="background-image: url('{{ asset('assets/foto/bgprofil.png') }}'); background-position-y: 50%;">
                    <span class="mask bg-gradient-info opacity-6"></span>
                </div>
                <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                    <div class="row gx-4">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative bg-gradient-info">
                                <img src="../assets/foto/dosentugasbelajar.png" alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm">
                            </div>
                        </div>
                        @if ($dosen->isNotEmpty())
                            @foreach ($dosen as $data)
                                <div class="col-auto my-auto">
                                    <div class="h-100">
                                        <h5 class="mb-1">{{ $data->nama_dosen }}</h5>
                                        <p class="mb-0 font-weight-bold text-sm">
                                            {{ $data->jabatan->nama_jabatan }} {{ $data->prodi->nama_prodi }} - DOSEN
                                            BERJABATAN
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Data dosen tidak tersedia.</p>
                        @endif

                        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3" data-bs-toggle="modal"
                            href="javascript:;" role="tab" aria-selected="false"
                            data-bs-target="#editPasswordModal">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="javascript:;"
                                            role="tab" aria-selected="false">
                                            <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <title>Edit</title>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF"
                                                        fill-rule="nonzero">
                                                        <g transform="translate(1716.000000, 291.000000)">
                                                            <g transform="translate(304.000000, 151.000000)">
                                                                <polygon class="color-background" opacity="0.596981957"
                                                                    points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                                                </polygon>
                                                                <path class="color-background"
                                                                    d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"
                                                                    opacity="0.596981957"></path>
                                                                <path class="color-background"
                                                                    d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.23666667,39.1133333 12.60333333,37.565 L27.15333333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                            <span class="ms-1">Edit Kata Sandi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Password -->
        <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPasswordModalLabel">Ubah Kata Sandi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="POST" action="{{ route('dosenberjabatan.profil.update.password') }}"
                        id="passwordForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Kata Sandi Saat Ini</label>
                                <input type="password" class="form-control" id="currentPassword" name="current_password"
                                    required>
                                @error('current_password')
                                    <div class="bg-gradient-danger text-white p-2 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Kata Sandi Baru</label>
                                <input type="password" class="form-control" id="newPassword" name="new_password"
                                    required>
                                @error('new_password')
                                    <div class="bg-gradient-danger text-white p-2 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" class="form-control" id="confirmPassword"
                                    name="new_password_confirmation" required>
                                @error('new_password_confirmation')
                                    <div class="bg-gradient-danger text-white p-2 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn bg-gradient-info">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            // First, initialize the modal properly at the top of your script
            let editPasswordModal;
            document.addEventListener('DOMContentLoaded', function() {
                editPasswordModal = new bootstrap.Modal(document.getElementById('editPasswordModal'));
            });

            document.getElementById('passwordForm').addEventListener('submit', function(event) {
                event.preventDefault();

                const currentPassword = document.getElementById('currentPassword').value;
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;

                // Basic validations
                if (!currentPassword || !newPassword || !confirmPassword) {
                    alert('Semua field harus diisi!');
                    event.target.reset(); // Reset form when validation fails
                    return;
                }

                if (newPassword.length < 8) {
                    alert('Kata sandi baru minimal 8 karakter!');
                    event.target.reset(); // Reset form when validation fails
                    return;
                }

                if (newPassword !== confirmPassword) {
                    alert('Kata sandi baru dan konfirmasi kata sandi tidak cocok!');
                    event.target.reset(); // Reset form when validation fails
                    return;
                }

                if (currentPassword === newPassword) {
                    alert('Kata sandi baru tidak boleh sama dengan kata sandi saat ini!');
                    event.target.reset(); // Reset form when validation fails
                    return;
                }

                // Create FormData
                const formData = new FormData();
                formData.append('current_password', currentPassword);
                formData.append('new_password', newPassword);
                formData.append('new_password_confirmation', confirmPassword);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                formData.append('_method', 'PUT');

                // Show loading state
                const submitButton = event.target.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML = 'Menyimpan...';

                fetch("{{ route('dosenberjabatan.profil.update.password') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Kata sandi berhasil diperbarui!');

                            // Reset form
                            event.target.reset();

                            // Close modal using the initialized instance
                            if (editPasswordModal) {
                                editPasswordModal.hide();
                            }

                            // Use a timeout to delay the redirect
                            setTimeout(() => {
                                window.location.href = @json(route('dosenberjabatan.profil.index'));
                            }, 500);
                        } else {
                            if (data.errors && data.errors.current_password) {
                                alert(data.errors.current_password[0]);
                                event.target.reset(); // Reset form when server validation fails
                            } else if (data.message) {
                                alert(data.message);
                                event.target.reset(); // Reset form when server returns error message
                            } else {
                                alert('Terjadi kesalahan. Silakan coba lagi.');
                                event.target.reset(); // Reset form when unknown error occurs
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                        event.target.reset(); // Reset form when fetch fails
                    })
                    .finally(() => {
                        // Reset button state
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalText;
                    });
            });
        </script>

    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
