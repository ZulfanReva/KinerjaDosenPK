<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaRoleController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login

        if ($user->role === 'admin') {
            // Logika untuk admin
            $dosenAktif = Dosen::where('status', 'Aktif')->count();
            $dosenTugasBelajar = Dosen::where('status', 'Nonaktif')->count();
            $jumlahProdi = Prodi::count();

            return view('pageadmin.berandaadmin', compact('dosenAktif', 'dosenTugasBelajar', 'jumlahProdi'));
        } elseif ($user->role === 'dosenberjabatan') {
            // Logika untuk dosen berjabatan
            return view('pagedosenberjabatan.berandadosenberjabatan');
        } else {
            // Jika role tidak dikenali
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}
