<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        // Mengambil semua data Prodi
        $prodis = Prodi::all();
    
        // Mengirim data Prodi ke tampilan
        return view('pageadmin.dataprodi.index', compact('prodis'));
        }

    // Menampilkan form tambah data
    public function create()
    {
        return view('pageadmin.dataprodi.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
    // Validasi input
    $request->validate([
        'nama_prodi' => 'required|array',
        'nama_prodi.*' => 'required|string|max:255',
    ]);

    // Simpan data prodi
    foreach ($request->nama_prodi as $namaProdi) {
        Prodi::create(['nama_prodi' => $namaProdi]);
    }

    // Setelah berhasil, redirect ke halaman daftar prodi
    return redirect()->route('admin.dataprodi.index')->with('success', 'Data Prodi berhasil disimpan!');
    }

    // Menampilkan detail data
    public function show($id)
    {
        return view('pageadmin.dataprodi.show', compact('id'));
    }

    // Menampilkan form edit data
    public function edit($id)
    {
        return view('pageadmin.dataprodi.edit', compact('id'));
    }

    // Memperbarui data
    public function update(Request $request, $id)
    {
        // Validasi dan update data
        return redirect()->route('pageadmin.dataprodi.index');
    }

    // Menghapus data
    public function destroy($id)
    {
        // Mencari data berdasarkan ID
        $prodi = Prodi::find($id);

        // Cek apakah data ditemukan
        if (!$prodi) {
            return response()->json([
                'success' => false,
                'message' => 'Data Prodi tidak ditemukan.'
            ], 404);  // Mengembalikan error 404 jika data tidak ditemukan
        }

        // Menghapus data
        $prodi->delete();

        // Mengirimkan pesan sukses dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Prodi berhasil dihapus!'
        ]);
    }

}
