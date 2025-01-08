<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\DataJabatanController;
use App\Http\Controllers\DataJatabanController;
use App\Http\Controllers\DataPeriodeController;
use App\Http\Controllers\PenilaianCFController;
use App\Http\Controllers\PenilaianPKController;
use App\Http\Controllers\PenilaianPMController;
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\DataPengawasController;
use App\Http\Controllers\PenilaianBKDController;
use App\Http\Controllers\ProfilPengawasController;

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
        } elseif (Auth::user()->role === 'pengawas') {
            return redirect()->route('pengawas.beranda'); // Redirect ke beranda pengawas
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
    
    // Data Pengawas menggunakan resource route
    Route::resource('datapengawas', DataPengawasController::class)->names([
    'index' => 'datapengawas.index',
    'create' => 'datapengawas.create',
    'store' => 'datapengawas.store',
    'show' => 'datapengawas.show',
    'edit' => 'datapengawas.edit',
    'update' => 'datapengawas.update',
    'destroy' => 'datapengawas.destroy',
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

    // Penilaian PM menggunakan resource route
    Route::resource('penilaianbkd', PenilaianBKDController::class)->names([
        'index' => 'penilaianbkd.index',
        'create' => 'penilaianbkd.create',
        'store' => 'penilaianbkd.store',
        'show' => 'penilaianbkd.show',
        'edit' => 'penilaianbkd.edit',
        'update' => 'penilaianbkd.update',
        'destroy' => 'penilaianbkd.destroy',
    ]);

    // Data Periode menggunakan resource route
    Route::resource('dataperiode', PeriodeController::class)->names([
        'index' => 'dataperiode.index',
        'create' => 'dataperiode.create',
        'store' => 'dataperiode.store',
        'show' => 'dataperiode.show',
        'edit' => 'dataperiode.edit',
        'update' => 'dataperiode.update',
        'destroy' => 'dataperiode.destroy',
    ]);

    // Profil Admin
    Route::get('/profiladmin', [ProfilAdminController::class, 'index'])->name('profiladmin');});
    Route::put('/profiladmin/update-password', [ProfilAdminController::class, 'updatePassword'])->name('admin.update.password');

Route::middleware(['auth'])->prefix('pengawas')->name('pengawas.')->group(function () {
    // Halaman beranda pengawas
    Route::view('/beranda', 'pagepengawas.berandapengawas')->name('beranda');
    
    // Route untuk halaman create penilaian pk dengan parameter dosen_id dan pengawas_id
    Route::get('penilaianpk/create/{dosen_id}/{pengawas_id}', [PenilaianPKController::class, 'create'])
        ->name('penilaianpk.create');
    
    // Menggunakan resource untuk sisa route
    Route::resource('penilaianpk', PenilaianPKController::class)->except(['create']);

    // Profil Pengawas
    Route::get('/profilpengawas', [ProfilPengawasController::class, 'index'])->name('profilpengawas');
    Route::put('/profilpengawas/update-password', [ProfilPengawasController::class, 'updatePassword'])->name('pengawas.update.password');
});