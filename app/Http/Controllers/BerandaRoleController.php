<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BerandaRoleController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login

        // Inisialisasi variabel untuk data yang akan dikirim ke view
        $dosenAktif = null;
        $dosenTugasBelajar = null;
        $jumlahProdi = null;

        // Logika untuk admin
        if ($user->role === 'admin') {
            $dosenAktif = Dosen::where('status', 'Aktif')->count();
            $dosenTugasBelajar = Dosen::where('status', 'Nonaktif')->count();
            $jumlahProdi = Prodi::count();
        }

        // Mengambil data dosen dengan penilaian tertinggi dan terendah untuk admin dan dosen berjabatan
        $topDosen = DB::table('penilaian_perilakukerja')
            ->join('dosen', 'penilaian_perilakukerja.dosen_id', '=', 'dosen.id')
            ->select('dosen.nama_dosen', 'penilaian_perilakukerja.total_nilai')
            ->orderByDesc('penilaian_perilakukerja.total_nilai')
            ->limit(5)
            ->get();

        $lowDosen = DB::table('penilaian_perilakukerja')
            ->join('dosen', 'penilaian_perilakukerja.dosen_id', '=', 'dosen.id')
            ->select('dosen.nama_dosen', 'penilaian_perilakukerja.total_nilai')
            ->orderBy('penilaian_perilakukerja.total_nilai')
            ->limit(5)
            ->get();

        // Mengambil data prodi dengan dosen bergrade A untuk admin dan dosen berjabatan
        $prodiWithGradeA = DB::table('penilaian_perilakukerja')
            ->join('dosen', 'penilaian_perilakukerja.dosen_id', '=', 'dosen.id')
            ->join('prodi', 'dosen.prodi_id', '=', 'prodi.id')
            ->whereBetween('penilaian_perilakukerja.total_nilai', [4.56, 5.00]) // Menggunakan total_nilai untuk menentukan grade A
            ->select('prodi.nama_prodi', DB::raw('count(dosen.id) as total_dosen'))
            ->groupBy('prodi.nama_prodi')
            ->get();

        // Kirim data ke view sesuai dengan role
        if ($user->role === 'admin') {
            return view('pageadmin.berandaadmin', compact(
                'dosenAktif',
                'dosenTugasBelajar',
                'jumlahProdi',
                'topDosen',
                'lowDosen',
                'prodiWithGradeA'
            ));
        } elseif ($user->role === 'dosenberjabatan') {
            return view('pagedosenberjabatan.berandadosenberjabatan', compact(
                'topDosen',
                'lowDosen',
                'prodiWithGradeA'
            ));
        } else {
            // Jika role tidak dikenali
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}
