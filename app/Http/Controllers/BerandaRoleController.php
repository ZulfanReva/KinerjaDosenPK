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

        if ($user->role === 'admin') {
            // Logika untuk admin
            $dosenAktif = Dosen::where('status', 'Aktif')->count();
            $dosenTugasBelajar = Dosen::where('status', 'Nonaktif')->count();
            $jumlahProdi = Prodi::count();

            // Mengambil data dosen dengan penilaian tertinggi dan terendah
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

            // Mengambil data prodi dengan jumlah dosen grade A
            $topProdi = DB::table('penilaian_perilakukerja')
                ->join('dosen', 'penilaian_perilakukerja.dosen_id', '=', 'dosen.id')
                ->join('prodi', 'dosen.prodi_id', '=', 'prodi.id')
                ->select('prodi.nama_prodi', DB::raw('count(dosen.id) as dosen_grade_A'))
                ->where('penilaian_perilakukerja.total_nilai', '>=', 85) // Menentukan grade A
                ->groupBy('prodi.id', 'prodi.nama_prodi')
                ->orderByDesc('dosen_grade_A')
                ->limit(5) // Menampilkan top 5 prodi
                ->get();

            // Kirim data ke view
            return view('pageadmin.berandaadmin', compact(
                'dosenAktif',
                'dosenTugasBelajar',
                'jumlahProdi',
                'topDosen',
                'lowDosen',
                'topProdi' // Pastikan hanya topProdi yang dikirim
            ));
        } elseif ($user->role === 'dosenberjabatan') {
            // Logika untuk dosen berjabatan
            return view('pagedosenberjabatan.berandadosenberjabatan');
        } else {
            // Jika role tidak dikenali
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}
