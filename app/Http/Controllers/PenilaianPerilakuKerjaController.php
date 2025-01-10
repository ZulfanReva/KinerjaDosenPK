<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Periode;
use App\Models\PenilaianPerilakuKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianPerilakuKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil dosen yang terhubung dengan user
        $dosenUser = $user->dosen;

        if (!$dosenUser) {
            // Jika user login bukan dosen, tampilkan error atau redirect
            return redirect()->back()->with('error', 'User tidak terkait dengan dosen.');
        }

        // Ambil prodi_id dari dosen yang login
        $userProdiId = $dosenUser->prodi_id;

        // Ambil semua penilaian perilaku kerja
        $penilaianPerilakuKerjas = PenilaianPerilakuKerja::whereIn('dosen_id', Dosen::where('prodi_id', $userProdiId)->pluck('id'))->get();

        // Ambil data dosen yang aktif, memiliki prodi yang sama, dan bukan dosen yang sedang login
        $dosenaktif = Dosen::where('status', 'Aktif')
            ->where('prodi_id', $userProdiId)
            ->where('id', '!=', $dosenUser->id) // Menambahkan pengecualian untuk dosen yang sedang login
            ->get();

        // Tambahkan properti isRated untuk setiap dosen aktif
        foreach ($dosenaktif as $dosen) {
            $dosen->isRated = $penilaianPerilakuKerjas->contains('dosen_id', $dosen->id);
        }

        // Kirim data ke view
        return view('pagedosenberjabatan.penilaianperilakukerja.index', compact('dosenaktif', 'penilaianPerilakuKerjas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($dosen_id)
    {
        // Mengambil data dosen berdasarkan id
        $dosen = Dosen::with('prodi')->findOrFail($dosen_id);

        // Ambil semua data periode
        $periodeList = Periode::all();

        return view('pagedosenberjabatan.penilaianperilakukerja.create', compact('dosen', 'periodeList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'pengawas_id' => 'required|exists:pengawas,id',
            'periode_id' => 'required|exists:periode,id',
            'orientasi_pelayanan' => 'required|numeric|min:0|max:5',
            'integritas' => 'required|numeric|min:0|max:5',
            'komitmen' => 'required|numeric|min:0|max:5',
            'disiplin' => 'required|numeric|min:0|max:5',
            'kerjasama' => 'required|numeric|min:0|max:5',
            'kepemimpinan' => 'required|numeric|min:0|max:5',
            'nilai_nsf' => 'required|numeric|between:0,5.00',
        ]);

        // Format nilai_nsf sebelum menyimpan
        $request->merge([
            'nilai_nsf' => number_format((float) $request->nilai_nsf, 2, '.', '')
        ]);

        // Menyimpan data penilaian PK baru
        PenilaianPerilakuKerja::create($request->all());

        // Redirect ke index dengan pesan sukses
        return redirect()->route('pagedosenberjabatan.penilaianperilakukerja.index')->with('success', 'Penilaian PK berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail penilaian PK berdasarkan ID
        $penilaianPK = PenilaianPerilakuKerja::findOrFail($id);
        return view('pagedosenberjabatan.penilaianperilakukerja.show', compact('penilaianPK'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form untuk mengedit penilaian PK
        $penilaianPK = PenilaianPerilakuKerja::findOrFail($id);
        return view('pagedosenberjabatan.penilaianperilakukerja.edit', compact('penilaianPK'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'pengawas_id' => 'required|exists:pengawas,id',
            'periode_id' => 'required|exists:periode,id',
            'orientasi_pelayanan' => 'required|numeric|min:0|max:5',
            'integritas' => 'required|numeric|min:0|max:5',
            'komitmen' => 'required|numeric|min:0|max:5',
            'disiplin' => 'required|numeric|min:0|max:5',
            'kerjasama' => 'required|numeric|min:0|max:5',
            'nilai_nsf' => 'required|numeric|between:0,5.00',
        ]);

        // Format nilai_nsf sebelum menyimpan
        $request->merge([
            'nilai_nsf' => number_format((float) $request->nilai_nsf, 2, '.', '')
        ]);

        // Mengupdate data penilaian PK
        $penilaianPK = PenilaianPerilakuKerja::findOrFail($id);
        $penilaianPK->update($request->all());

        // Redirect ke index dengan pesan sukses
        return redirect()->route('pagedosenberjabatan.penilaianperilakukerja.index')->with('success', 'Penilaian Perilaku Kerja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari data berdasarkan ID
        $penilaianPK = PenilaianPerilakuKerja::find($id);

        // Cek apakah data ditemukan
        if (!$penilaianPK) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);  // Mengembalikan error 404 jika data tidak ditemukan
        }

        // Menghapus data
        $penilaianPK->delete();

        // Mengirimkan pesan sukses dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
