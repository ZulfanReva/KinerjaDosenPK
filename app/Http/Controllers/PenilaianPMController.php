<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Periode;
use App\Models\PenilaianPK;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\PendingHasThroughRelationship;
use App\Models\PenilaianPM; // Asumsikan model PenilaianPM sudah ada

class PenilaianPMController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
    {
        // Ambil data dosen aktif beserta nilai PK, periode, dan nilai CF
        $dataDosen = Dosen::where('status', 'Aktif')
            ->with([
                'prodi',  // Relasi prodi untuk menampilkan nama prodi
                'penilaianPK' => function ($query) {
                    $query->select('dosen_id', 'nilai_nsf', 'periode_id'); // Tambahkan kolom periode_id dan nilai_nsf
                },
                'penilaianPK.periode' => function ($query) {
                    $query->select('id', 'nama_periode'); // Pastikan hanya mengambil kolom yang diperlukan dari tabel periode
                },
                'penilaianBKD' => function ($query) {
                    $query->select('dosen_id', 'nilai_ncf'); // Menyertakan relasi penilaianBKD dan hanya mengambil nilai_ncf
                }
            ])
            ->get();

        // Menghitung nilai PM untuk setiap dosen
        foreach ($dataDosen as $dosen) {
            if ($dosen->penilaianBKD && $dosen->penilaianPK) {
                // Mengambil nilai_ncf dari penilaianBKD dan nilai_nsf dari penilaianPK
                $nilaiNcf = $dosen->penilaianBKD->nilai_ncf;
                $nilaiNsf = $dosen->penilaianPK->nilai_nsf;

                // Menghitung nilai PM menggunakan rumus
                $nilaiPm = (0.60 * $nilaiNcf) + (0.40 * $nilaiNsf);

                // Menyimpan nilai PM ke dalam properti sementara untuk ditampilkan di view
                $dosen->nilai_pm = round($nilaiPm, 2); // Membulatkan nilai PM ke 2 desimal
            } else {
                // Jika tidak ada nilai CF atau SF, set nilai PM sebagai null atau kosong
                $dosen->nilai_pm = null;
            }
        }

        return view('pageadmin.penilaianpm.index', compact('dataDosen'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
        return view('pageadmin.penilaiancf.create', compact('dosen', 'periodeList', 'selectedPeriode'));
    }

    public function store(Request $request)
    {

        return redirect()->route('admin.penilaianpm.index')->with('success', 'Penilaian berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail data penilaian berdasarkan ID
        $penilaian = PenilaianPM::findOrFail($id);

        // Fetching the list of periods (Periode)
        $periodeList = Periode::all();  // Assuming 'Periode' is your model

        // Passing both penilaian and periodeList to the view
        return view('pageadmin.penilaianpm.show', compact('penilaian', 'periodeList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form edit untuk data penilaian
        $penilaian = PenilaianPM::findOrFail($id);
        return view('pageadmin.penilaianpm.edit', compact('penilaian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|numeric',
        ]);

        // Update data di database
        $penilaian = PenilaianPM::findOrFail($id);
        $penilaian->update($request->all());

        return redirect()->route('pageadmin.penilaianpm.index')
                         ->with('success', 'Penilaian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari data dosen berdasarkan ID
        $dosen = Dosen::findOrFail($id);
        
        // Menghapus data penilaianBKD dan penilaianPK terkait dosen
        $dosen->penilaianBKD()->delete();
        $dosen->penilaianPK()->delete();

        // Menghapus data dosen itu sendiri
        $dosen->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.penilaianpm.index')->with('success', 'Data berhasil dihapus');
    }
}