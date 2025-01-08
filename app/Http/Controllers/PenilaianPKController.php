<?php

namespace App\Http\Controllers;

    use App\Models\Dosen;
    use App\Models\Periode;
    use App\Models\Pengawas;
    use Illuminate\Http\Request;
    use App\Models\PenilaianPK; // Pastikan Anda menggunakan model yang benar

    class PenilaianPKController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            // Mengambil semua data penilaian PK
            $penilaianPKs = PenilaianPK::all();

            // Mengambil data dosen yang statusnya aktif
            $dosenaktif = Dosen::where('status', 'Aktif')->get();

            // Mengambil data pengawas
            $pengawas = Pengawas::with('jabatan')->get();

            // Menambahkan properti isRated untuk setiap dosen aktif
            foreach ($dosenaktif as $dosen) {
                $dosen->isRated = $penilaianPKs->contains(function ($penilaian) use ($dosen) {
                    return $penilaian->dosen_id === $dosen->id;
                });
            }

            return view('pagepengawas.penilaianpk.index', compact('penilaianPKs', 'dosenaktif', 'pengawas'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create($dosen_id, $pengawas_id)
        {
            // Mengambil data dosen berdasarkan id
            $dosen = Dosen::with('prodi')->findOrFail($dosen_id);
        
            // Mengambil data pengawas berdasarkan id
            $pengawas = Pengawas::with('jabatan')->findOrFail($pengawas_id);

            // Ambil semua data periode
            $periodeList = Periode::all();

            return view('pagepengawas.penilaianpk.create', compact('dosen', 'pengawas', 'periodeList'));
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
            PenilaianPK::create($request->all());

            // Redirect ke index dengan pesan sukses
            return redirect()->route('pengawas.penilaianpk.index')->with('success', 'Penilaian PK berhasil disimpan.');
        }

        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
            // Menampilkan detail penilaian PK berdasarkan ID
            $penilaianPK = PenilaianPK::findOrFail($id);
            return view('pagepengawas.penilaianpk.show', compact('penilaianPK'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
            // Menampilkan form untuk mengedit penilaian PK
            $penilaianPK = PenilaianPK::findOrFail($id);
            return view('pagepengawas.penilaianpk.edit', compact('penilaianPK'));
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
            $penilaianPK = PenilaianPK::findOrFail($id);
            $penilaianPK->update($request->all());

            // Redirect ke index dengan pesan sukses
            return redirect()->route('pengawas.penilaianpk.index')->with('success', 'Penilaian PK berhasil diperbarui.');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy($id)
        {
            // Mencari data berdasarkan ID
            $penilaianPK = PenilaianPK::find($id);

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
