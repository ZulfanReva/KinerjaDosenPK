<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PenilaianPerilakuKerja;
use Carbon\Carbon;

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
            $penilaian = PenilaianPerilakuKerja::with(['dosen.prodi', 'user.dosen'])->findOrFail($id);
            return view('pageadmin.penilaianprofilematching.show', compact('penilaian'));
        } catch (\Exception $e) {
            // Perbaiki nama route disini
            return redirect()->route('admin.penilaianprofilematching.index')
                ->with('error', 'Data penilaian tidak ditemukan.');
        }
    }

    public function exportPDF(Request $request)
    {
        // Get filtered data based on request parameters
        $query = PenilaianPerilakuKerja::with(['dosen.prodi', 'user.dosen']);

        if ($request->has('prodi') && $request->prodi) {
            $query->whereHas('dosen.prodi', function ($q) use ($request) {
                $q->where('id', $request->prodi);
            });
        }

        if ($request->has('periode') && $request->periode) {
            $query->where('periode', $request->periode);
        }

        $penilaianPerilaku = $query->get();

        // Calculate grades and add as attribute
        $penilaianPerilaku->map(function ($penilaian) {
            $nilai = $penilaian->total_nilai;
            $penilaian->grade = $nilai >= 4.56 ? 'A' : ($nilai >= 3.56 ? 'B' : ($nilai >= 2.56 ? 'C' : ($nilai >= 1.56 ? 'D' : 'E')));
            return $penilaian;
        });

        // Sort collection by total_nilai (descending) and grade
        $penilaianPerilaku = $penilaianPerilaku->sortByDesc(function ($penilaian) {
            // Create a custom sorting array: first by total_nilai, then by grade
            $gradeOrder = [
                'A' => 1,
                'B' => 2,
                'C' => 3,
                'D' => 4,
                'E' => 5
            ];

            // Return an array with both sorting criteria
            return [$penilaian->total_nilai, $gradeOrder[$penilaian->grade]];
        });

        // Encode images to base64
        $kopImage = base64_encode(file_get_contents(public_path('assets/foto/kopsurat.png')));
        $ttdImage = base64_encode(file_get_contents(public_path('assets/foto/ttddigital.png')));

        $pdf = PDF::loadView('pageadmin.penilaianprofilematching.pdf', [
            'penilaianPerilaku' => $penilaianPerilaku,
            'exportDate' => Carbon::now()->format('d-m-Y H:i:s'),
            'kopBase64' => 'data:image/png;base64,' . $kopImage,
            'ttdBase64' => 'data:image/png;base64,' . $ttdImage
        ]);

        $pdf->getDomPDF()->set_option('isRemoteEnabled', true);
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);

        return $pdf->download('penilaian-perilaku-kerja-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }
}
