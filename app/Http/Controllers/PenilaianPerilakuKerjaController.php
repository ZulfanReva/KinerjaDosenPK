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
    public function create(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil data dosen berdasarkan dosen_id yang dikirimkan
        $dosen = Dosen::findOrFail($request->dosen_id);

        // Ambil data dosen berdasarkan user yang login (profil dosen berjabatan)
        $dosenBerjabatan = Dosen::with('jabatan')->where('users_id', $user->id)->firstOrFail();

        // Ambil daftar periode dari database
        $periodeList = Periode::pluck('nama_periode');

        return view('pagedosenberjabatan.penilaianperilakukerja.create', compact('dosen', 'dosenBerjabatan', 'periodeList'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil dosen berjabatan berdasarkan users_id dari user yang sedang login
        $dosenBerjabatan = Dosen::where('users_id', $user->id)->firstOrFail();

        // Validasi input
        $request->validate([
            'dosen_id' => 'required|exists:dosen,id', // Dosen yang dinilai
            'periode' => 'required|string',
            'integritas' => 'required|integer|min:1|max:5',
            'komitmen' => 'required|integer|min:1|max:5',
            'kerjasama' => 'required|integer|min:1|max:5',
            'orientasi_pelayanan' => 'required|integer|min:1|max:5',
            'disiplin' => 'required|integer|min:1|max:5',
            'kepemimpinan' => 'required|integer|min:1|max:5', // Mengubah menjadi required
            'tanggal_penilaian' => 'required|date', // Validasi tanggal penilaian
            'total_nilai' => 'required|numeric', // Validasi total nilai menjadi required
        ]);

        // Menambahkan data tambahan untuk users_id dan total_nilai
        $data = $request->all();
        $data['users_id'] = $user->id; // Menambahkan ID pengguna yang sedang login

        // Simpan data ke tabel penilaian_perilakukerja
        PenilaianPerilakuKerja::create($data);

        // Redirect dengan pesan sukses
        return redirect()->route('dosenberjabatan.penilaianperilakukerja.index')
            ->with('success', 'Penilaian Perilaku Kerja Berhasil dimasukkan!');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        // Menampilkan detail penilaian PK berdasarkan ID
        $penilaianPerilakuKerjas = PenilaianPerilakuKerja::findOrFail($id);
        return view('dosenberjabatan.penilaianperilakukerja.show', compact('penilaianperilakukerja'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form untuk mengedit penilaian PK
        $penilaianPerilakuKerjas = PenilaianPerilakuKerja::findOrFail($id);
        return view('dosenberjabatan.penilaianperilakukerja.edit', compact('penilaianperilakukerja'));
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
        $penilaianPerilakuKerjas = PenilaianPerilakuKerja::findOrFail($id);
        $penilaianPerilakuKerjas->update($request->all());

        // Redirect ke index dengan pesan sukses
        return redirect()->route('dosenberjabatan.penilaianperilakukerja.index')->with('success', 'Penilaian Perilaku Kerja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari data berdasarkan ID
        $penilaianPerilakuKerjas = PenilaianPerilakuKerja::find($id);

        // Cek apakah data ditemukan
        if (!$penilaianPerilakuKerjas) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);  // Mengembalikan error 404 jika data tidak ditemukan
        }

        // Menghapus data
        $penilaianPerilakuKerjas->delete();

        // Mengirimkan pesan sukses dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
