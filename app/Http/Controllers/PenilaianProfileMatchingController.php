<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PenilaianPerilakuKerja;

class PenilaianProfileMatchingController extends Controller
{
    public function index(Request $request)
    {
        // Ambil list Prodi untuk dropdown
        $prodiList = Prodi::all();

        // Ambil list periode untuk dropdown (sesuaikan dengan cara periode ditentukan)
        $periodeList = PenilaianPerilakuKerja::distinct()->pluck('periode')->toArray();

        // Query penilaian dengan filter jika ada
        $penilaianPerilaku = PenilaianPerilakuKerja::query();

        if ($request->filled('prodi')) {
            $penilaianPerilaku->whereHas('dosen.prodi', function ($query) use ($request) {
                $query->where('id', $request->prodi);
            });
        }

        if ($request->filled('periode')) {
            $penilaianPerilaku->where('periode', $request->periode);
        }

        // Ambil data penilaian sesuai filter
        $penilaianPerilaku = $penilaianPerilaku->get();

        // Kirim data ke tampilan
        return view('pageadmin.penilaianprofilematching.index', [
            'penilaianPerilaku' => $penilaianPerilaku,
            'prodiList' => $prodiList,
            'periodeList' => $periodeList,
        ]);
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
}
