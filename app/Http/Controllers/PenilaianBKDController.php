<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Periode;
use App\Models\PenilaianBKD;
use App\Models\PenilaianPK;
use App\Models\PenilaianPM;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PenilaianBKDController extends Controller
{
    public function create(Request $request)
    {
        // Ambil data dosen berdasarkan ID yang dikirimkan
        $dosen = Dosen::find($request->dosen_id);

        if (!$dosen) {
            return redirect()->route('pageadmin.penilaianpm.index')->with('error', 'Dosen tidak ditemukan.');
        }

        // Ambil semua data periode
        $periodeList = Periode::all();

        // Cari periode terakhir dari penilaian PK terkait dosen ini
        $selectedPeriode = PenilaianPK::where('dosen_id', $dosen->id)
            ->with('periode') // Pastikan relasi periode di model PenilaianPK sudah dibuat
            ->orderBy('created_at', 'desc')
            ->first()?->periode;

        // Kirimkan data ke blade
        return view('pageadmin.penilaianbkd.create', compact('dosen', 'periodeList', 'selectedPeriode'));
    }

    public function store(Request $request)
{

    // Validasi data yang dikirimkan
    $validated = $request->validate([
        'dosen_id' => 'required|exists:dosen,id',
        'periode_id' => 'required|exists:periode,id', // Ubah dari 'periode' ke 'periode_id'
        'bidang_pendidikan' => 'required|in:1,2',
        'bidang_penelitian' => 'required|in:1,2',
        'bidang_pengabdian' => 'required|in:1,2',
        'bidang_penunjang' => 'required|in:1,2',
        'nilai_ncf' => 'required|numeric',
    ]);

    // Membuat data penilaian baru
    $penilaian = new PenilaianBKD();
    $penilaian->dosen_id = $request->dosen_id;
    $penilaian->periode_id = $request->periode_id;
    $penilaian->bidang_pendidikan = $request->bidang_pendidikan;
    $penilaian->bidang_penelitian = $request->bidang_penelitian;
    $penilaian->bidang_pengabdian = $request->bidang_pengabdian;
    $penilaian->bidang_penunjang = $request->bidang_penunjang;
    $penilaian->nilai_ncf = $request->nilai_ncf;

    // Menyimpan ke database
    $penilaian->save();

    // Redirect atau memberi feedback setelah berhasil
    return redirect()->route('admin.penilaianpm.index')
                     ->with('success', 'Penilaian berhasil disimpan.');
}
}
