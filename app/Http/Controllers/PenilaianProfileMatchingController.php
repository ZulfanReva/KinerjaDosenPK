<?php

namespace App\Http\Controllers;

use App\Models\PenilaianPerilakuKerja;
use Illuminate\Http\Request;

class PenilaianProfileMatchingController extends Controller
{
    public function index()
    {
        $penilaianPerilaku = PenilaianPerilakuKerja::with(['dosen.user'])->get();
        return view('pageadmin.penilaianprofilematching.index', compact('penilaianPerilaku'));
    }

    public function destroy($id)
    {
        try {
            // Cari data berdasarkan ID
            $penilaian = PenilaianPerilakuKerja::findOrFail($id);

            // Hapus data
            $penilaian->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('pageadmin.penilaianprofilematching.index')
                ->with('success', 'Data penilaian berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangani kesalahan (jika ada)
            return redirect()->route('pageadmin.penilaianprofilematching.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
