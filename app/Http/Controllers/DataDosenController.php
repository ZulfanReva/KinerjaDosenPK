<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;

class DataDosenController extends Controller
{
    // Menampilkan daftar data dosen
    public function index()
    {
        $dosens = Dosen::with('prodi')->get(); // Memuat relasi Prodi
        return view('pageadmin.datadosen.index', compact('dosens'));
    }

    // Menampilkan form tambah data dosen
    public function create()
    {
        // Mengambil semua data prodi
        $prodis = Prodi::all();
        
        // Mengirim data ke view
        return view('pageadmin.datadosen.create', compact('prodis'));
    }

    // Menyimpan data dosen baru
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama_dosen' => 'required|array',
            'nama_dosen.*' => 'required|string|max:255',
            'nidn' => 'required|array',
            'nidn.*' => 'required|string|max:20',
            'prodi_id' => 'required|array',
            'prodi_id.*' => 'required|exists:prodi,id',
            'status' => 'required|array',
            'status.*' => 'required|in:Aktif,Nonaktif',
        ]);

        // Menyimpan data dosen sekaligus menggunakan insert
        $data = [];
        foreach ($request->nama_dosen as $key => $namaDosen) {
            $data[] = [
                'nama_dosen' => $namaDosen,
                'nidn' => $request->nidn[$key],
                'prodi_id' => $request->prodi_id[$key],
                'status' => $request->status[$key],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Dosen::insert($data);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.datadosen.index')->with('success', 'Data Dosen berhasil disimpan!');
    }

    // Menampilkan detail data dosen
    public function show($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('pageadmin.datadosen.show', compact('dosen'));
    }

    // Menampilkan form edit data dosen
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        $prodis = Prodi::all(); // Mengambil semua data prodi
        return view('pageadmin.datadosen.edit', compact('dosen', 'prodis'));
    }

    // Memperbarui data dosen
    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nidn' => 'required|string|max:20',
            'prodi_id' => 'required|exists:prodi,id',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);
        
        try {
            // Cari dosen berdasarkan ID
            $dosen = Dosen::findOrFail($id);

            // Update data dosen
            $dosen->update([
                'nama_dosen' => $validatedData['nama_dosen'],
                'nidn' => $validatedData['nidn'],
                'prodi_id' => $validatedData['prodi_id'],
                'status' => $validatedData['status'],
            ]);

            // Mengembalikan respons sukses
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            // Menangani kesalahan dan mengembalikan error
            return response()->json(['success' => false, 'message' => 'Gagal mengupdate data: ' . $e->getMessage()]);
        }
    }
    // Menghapus data dosen
    public function destroy($id)
    {
        // Mencari data berdasarkan ID
        $dosen = Dosen::findOrFail($id);

        // Cek apakah data ditemukan
        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Data Dosen tidak ditemukan.'
            ], 404);  // Mengembalikan error 404 jika data tidak ditemukan
        }

        // Menghapus data
         // Menghapus data
    $dosen->delete();

    // Redirect setelah menghapus data
    return redirect()->route('admin.datadosen.index')->with('success', 'Data Dosen berhasil dihapus!');
    }
}
