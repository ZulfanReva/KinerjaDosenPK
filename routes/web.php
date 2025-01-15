<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MasukController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\BerandaRoleController;
use App\Http\Controllers\DataJabatanController;
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\ProfilDosenBerjabatanController;
use App\Http\Controllers\PenilaianPerilakuKerjaController;
use App\Http\Controllers\PenilaianProfileMatchingController;

// Route untuk halaman beranda
Route::get('/', [BerandaController::class, 'index'])->name('index');

// Route untuk halaman kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// Route untuk halaman login
Route::get('/masuk', function () {
    if (Auth::check()) {
        // Cek peran pengguna
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.beranda')
            : redirect()->route('dosenberjabatan.beranda');
    }
    return view('masuk');
})->name('masuk');

// Proses login
Route::post('/masuk', [MasukController::class, 'login'])->name('login');

// Logout
Route::post('/logout', [MasukController::class, 'logout'])->name('logout');

// Route untuk admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Halaman beranda admin
    Route::get('/beranda', [BerandaRoleController::class, 'index'])->name('beranda');

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
    Route::resource('dataprodi', ProdiController::class);

    // Data Jabatan menggunakan resource route
    Route::resource('datajabatan', DataJabatanController::class);

    // Penilaian Profile Matching
    Route::resource('penilaianprofilematching', PenilaianProfileMatchingController::class);
    Route::get('/penilaian/pdf/{id}', [PenilaianProfileMatchingController::class, 'generatePDF'])->name('penilaian.generatePDF');

    // Profil Admin
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [ProfilAdminController::class, 'index'])->name('index');
        Route::put('/update-password', [ProfilAdminController::class, 'updatePassword'])->name('update.password');
        Route::post('/check-password', [ProfilAdminController::class, 'checkPassword'])->name('checkPassword');
    });
});

// Route untuk dosen berjabatan
Route::middleware(['auth'])->prefix('dosenberjabatan')->name('dosenberjabatan.')->group(function () {
    // Halaman beranda dosen berjabatan
    Route::get('/beranda', [BerandaRoleController::class, 'index'])->name('beranda');

    // Penilaian Perilaku Kerja
    Route::resource('penilaianperilakukerja', PenilaianPerilakuKerjaController::class)->except(['create']);
    Route::get('penilaianperilakukerja/create/{dosen_id}', [PenilaianPerilakuKerjaController::class, 'create'])->name('penilaianperilakukerja.create');

    // Profil Dosen Berjabatan
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [ProfilDosenBerjabatanController::class, 'index'])->name('index');
        Route::put('/update-password', [ProfilDosenBerjabatanController::class, 'updatePassword'])->name('update.password');
    });
});
