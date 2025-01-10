<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\DataJabatanController;
use App\Http\Controllers\PenilaianPMController;
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\ProfilDosenBerjabatanController;
use App\Http\Controllers\PenilaianPerilakuKerjaController;

// Route untuk halaman beranda
Route::get('/', [BerandaController::class, 'index'])->name('index');

// Route untuk halaman kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// Route untuk halaman login
Route::get('/masuk', function () {
    if (Auth::check()) {
        // Cek peran pengguna
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.beranda'); // Redirect ke beranda admin
        } elseif (Auth::user()->role === 'dosenberjabatan') {
            return redirect()->route('dosenberjabatan.beranda'); // Redirect ke beranda dosenberjabatan
        }
    }
    return view('masuk'); // Ganti dengan 'masuk' sesuai nama file tampilan Anda
})->name('masuk');

// Proses login
Route::post('/masuk', [MasukController::class, 'login'])->name('login');

// Logout
Route::post('/logout', [MasukController::class, 'logout'])->name('logout');

// Route untuk halaman admin (Proteksi dengan middleware auth)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Halaman beranda admin
    Route::view('/beranda', 'pageadmin.berandaadmin')->name('beranda');

    // Data Dosen menggunakan resource route
    Route::resource('datadosen', DataDosenController::class)->names([
        'index' => 'datadosen.index',
        'create' => 'datadosen.create',
        'store' => 'datadosen.store',
        'show' => 'datadosen.show',
        'edit' => 'datadosen.edit',
        'update' => 'datadosen.update',
        'destroy' => 'datadosen.destroy',
    ]);

    // Data Prodi menggunakan resource route
    Route::resource('dataprodi', ProdiController::class)->names([
        'index' => 'dataprodi.index',
        'create' => 'dataprodi.create',
        'store' => 'dataprodi.store',
        'show' => 'dataprodi.show',
        'edit' => 'dataprodi.edit',
        'update' => 'dataprodi.update',
        'destroy' => 'dataprodi.destroy',
    ]);

    // Data Jabatan menggunakan resource route
    Route::resource('datajabatan', DataJabatanController::class)->names([
        'index' => 'datajabatan.index',
        'create' => 'datajabatan.create',
        'store' => 'datajabatan.store',
        'show' => 'datajabatan.show',
        'edit' => 'datajabatan.edit',
        'update' => 'datajabatan.update',
        'destroy' => 'datajabatan.destroy',
    ]);

    // Penilaian PM menggunakan resource route
    Route::resource('penilaianpm', PenilaianPMController::class)->names([
        'index' => 'penilaianpm.index',
        'create' => 'penilaianpm.create',
        'store' => 'penilaianpm.store',
        'show' => 'penilaianpm.show',
        'edit' => 'penilaianpm.edit',
        'update' => 'penilaianpm.update',
        'destroy' => 'penilaianpm.destroy',
    ]);

    // Profil Admin
    Route::get('/profiladmin', [ProfilAdminController::class, 'index'])->name('profiladmin');
});
Route::put('/profiladmin/update-password', [ProfilAdminController::class, 'updatePassword'])->name('admin.update.password');

Route::middleware(['auth'])->prefix('dosenberjabatan')->name('dosenberjabatan.')->group(function () {
    // Halaman beranda dosen berjabatan
    Route::view('/beranda', 'dosenberjabatan.berandadosenberjabatan')->name('beranda');

     // Menggunakan resource untuk sisa route
     Route::resource('penilaianperilakukerja', PenilaianPerilakuKerjaController::class)->except(['create']);

    // Route untuk halaman create penilaian pk dengan parameter dosen_id
    Route::get('penilaianperilakukerja/create/{dosen_id}', [PenilaianPerilakuKerjaController::class, 'create'])
        ->name('penilaianperilakukerja.create');

    // Profil dosen berjabatan
    Route::get('/profildosenberjabatan', [ProfilDosenBerjabatanController::class, 'index'])->name('profildosenberjabatan');
    Route::put('/profildosenberjabatan/update-password', [ProfilDosenBerjabatanController::class, 'updatePassword'])->name('dosenberjabatan.update.password');
});
