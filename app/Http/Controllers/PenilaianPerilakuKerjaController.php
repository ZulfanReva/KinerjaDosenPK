<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianPerilakuKerja;
use App\Models\Dosen;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;

class PenilaianPerilakuKerjaController extends Controller
{
    /**
     * Tampilkan daftar penilaian perilaku kerja.
     */
    public function index()
    {
        $user = Auth::user();
        $dosenUser = $user->dosen;

        if (!$dosenUser) {
            return redirect()->back()->with('error', 'User tidak terkait dengan dosen.');
        }

        $userProdiId = $dosenUser->prodi_id;

        // Ambil semua penilaian perilaku kerja dengan relasi periode
        $penilaianPerilakuKerjas = PenilaianPerilakuKerja::with('periode')
            ->whereIn('dosen_id', Dosen::where('prodi_id', $userProdiId)->pluck('id'))
            ->get();

        $dosenaktif = Dosen::where('status', 'Aktif')
            ->where('prodi_id', $userProdiId)
            ->where('id', '!=', $dosenUser->id)
            ->get();

        foreach ($dosenaktif as $dosen) {
            $dosen->isRated = $penilaianPerilakuKerjas->contains('dosen_id', $dosen->id);
        }

        return view('pagedosenberjabatan.penilaianperilakukerja.index', compact('dosenaktif', 'penilaianPerilakuKerjas'));
    }

    /**
     * Tampilkan form untuk membuat penilaian baru.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $dosen = Dosen::findOrFail($request->dosen_id);
        $dosenBerjabatan = Dosen::with('jabatan')->where('users_id', $user->id)->firstOrFail();

        // Ambil daftar periode dari tabel `periode` dalam bentuk koleksi
        $periodeList = Periode::all();

        return view('pagedosenberjabatan.penilaianperilakukerja.create', compact('dosen', 'dosenBerjabatan', 'periodeList'));
    }
    /**
     * Simpan data penilaian ke dalam database.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $dosenBerjabatan = Dosen::where('users_id', $user->id)->firstOrFail();

        $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'periode_id' => 'required|exists:periode,id',  // Validasi untuk periode_id
            'integritas' => 'required|integer|min:1|max:5',
            'komitmen' => 'required|integer|min:1|max:5',
            'kerjasama' => 'required|integer|min:1|max:5',
            'orientasi_pelayanan' => 'required|integer|min:1|max:5',
            'disiplin' => 'required|integer|min:1|max:5',
            'kepemimpinan' => 'required|integer|min:1|max:5',
            'tanggal_penilaian' => 'required|date',
            'total_nilai' => 'required|numeric',
        ]);

        // Menyimpan PenilaianPerilakuKerja
        PenilaianPerilakuKerja::create([
            'dosen_id' => $request->dosen_id,
            'periode_id' => $request->periode_id,  // Pastikan periode_id terisi
            'integritas' => $request->integritas,
            'komitmen' => $request->komitmen,
            'kerjasama' => $request->kerjasama,
            'orientasi_pelayanan' => $request->orientasi_pelayanan,
            'disiplin' => $request->disiplin,
            'kepemimpinan' => $request->kepemimpinan,
            'tanggal_penilaian' => $request->tanggal_penilaian,
            'total_nilai' => $request->total_nilai,
            'users_id' => $user->id,
        ]);

        return redirect()->route('dosenberjabatan.penilaianperilakukerja.index')
            ->with('success', 'Penilaian Perilaku Kerja berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail penilaian berdasarkan ID.
     */
    public function show($id)
    {
        $penilaianPerilakuKerja = PenilaianPerilakuKerja::with('periode')->findOrFail($id);
        return view('pagedosenberjabatan.penilaianperilakukerja.show', compact('penilaianPerilakuKerja'));
    }

    /**
     * Tampilkan form edit penilaian.
     */
    public function edit($id)
    {
        $penilaianPerilakuKerja = PenilaianPerilakuKerja::with('periode')->findOrFail($id);
        $periodeList = Periode::pluck('nama_periode', 'id');

        return view('pagedosenberjabatan.penilaianperilakukerja.edit', compact('penilaianPerilakuKerja', 'periodeList'));
    }

    /**
     * Perbarui data penilaian.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'periode_id' => 'required|exists:periode,id',
            'integritas' => 'required|numeric|min:0|max:5',
            'komitmen' => 'required|numeric|min:0|max:5',
            'kerjasama' => 'required|numeric|min:0|max:5',
            'orientasi_pelayanan' => 'required|numeric|min:0|max:5',
            'disiplin' => 'required|numeric|min:0|max:5',
            'kepemimpinan' => 'required|numeric|min:0|max:5',
            'total_nilai' => 'required|numeric|between:0,5.00',
            'tanggal_penilaian' => 'required|date',
        ]);

        $penilaianPerilakuKerja = PenilaianPerilakuKerja::findOrFail($id);
        $penilaianPerilakuKerja->update($request->all());

        return redirect()->route('dosenberjabatan.penilaianperilakukerja.index')
            ->with('success', 'Penilaian Perilaku Kerja berhasil diperbarui.');
    }

    /**
     * Hapus data penilaian.
     */
    public function destroy($id)
    {
        $penilaianPerilakuKerja = PenilaianPerilakuKerja::find($id);

        if (!$penilaianPerilakuKerja) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $penilaianPerilakuKerja->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
