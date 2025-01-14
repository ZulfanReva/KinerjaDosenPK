<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PenilaianPerilakuKerja;
use Illuminate\Http\Request;

class PenilaianProfileMatchingController extends Controller
{
    public function index()
    {
        $penilaianPerilaku = PenilaianPerilakuKerja::with(['dosen.user'])->get();
        return view('pageadmin.penilaianprofilematching.index', compact('penilaianPerilaku'));
    }

    public function show($id)
    {
        try {
            // Ambil data berdasarkan ID beserta relasi terkait
            $penilaian = PenilaianPerilakuKerja::with(['dosen.prodi', 'user.dosen'])->findOrFail($id);

            // Tampilkan halaman detail
            return view('pageadmin.penilaianprofilematching.show', compact('penilaian'));
        } catch (\Exception $e) {
            // Tangani jika data tidak ditemukan
            return redirect()->route('pageadmin.penilaianprofilematching.index')
                ->with('error', 'Data penilaian tidak ditemukan.');
        }
    }

    public function generatePDF($id)
    {
        try {
            // Ambil data yang diperlukan
            $penilaian = PenilaianPerilakuKerja::with(['dosen.prodi', 'user.dosen'])->findOrFail($id);

            // Muat tampilan untuk PDF dan kirim data
            // Pastikan layout dari show juga diterapkan di PDF
            $pdf = Pdf::loadView('pageadmin.penilaianprofilematching.show', compact('penilaian'));

            // Stream PDF langsung ke browser
            return $pdf->stream('Penilaian_' . $id . '.pdf');
        } catch (\Exception $e) {
            // Tangani kesalahan jika ada
            return redirect()->route('admin.penilaianprofilematching.index')
                ->with('error', 'Terjadi kesalahan saat membuat PDF.');
        }
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
