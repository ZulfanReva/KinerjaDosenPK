<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    // Menampilkan daftar data
    public function index(Request $request)
    {
        // Mengambil parameter sort dari query string, default ke 'asc' (ascending)
        $sortOrder = $request->get('sort', 'asc');

        // Mengambil data Prodi dengan sorting berdasarkan nama_prodi
        $prodis = Prodi::orderBy('nama_prodi', $sortOrder)->get();

        // Mengirim data Prodi dan urutan sort ke tampilan
        return view('pageadmin.dataprodi.index', compact('prodis', 'sortOrder'));
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
            'nama_prodi' => 'required|string|max:30|unique:prodi,nama_prodi', // Pastikan unique di database
        ], [
            'nama_prodi.string' => 'Nama prodi harus berupa teks.',
            'nama_prodi.required' => 'Nama prodi wajib diisi.',
            'nama_prodi.unique' => 'Prodi ":input" sudah terdaftar dalam database.',
            'nama_prodi.max' => 'Nama prodi tidak boleh melebihi 30 karakter.',
        ]);

        // Simpan data prodi
        Prodi::create(['nama_prodi' => $request->nama_prodi]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.dataprodi.index')
            ->with('success', 'Data Prodi berhasil ditambah!');
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
            return redirect()->route('admin.dataprodi.index')->with('error', 'Data Prodi tidak ditemukan.');
        }

        // Menghapus data
        $prodi->delete();

        // Mengirimkan pesan sukses
        return redirect()->route('admin.dataprodi.index')->with('success', 'Data Prodi berhasil dihapus!');
    }
}
