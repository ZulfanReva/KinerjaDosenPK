<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class DataJabatanController extends Controller
{
    // Menampilkan daftar data
    public function index(Request $request)
    {
        // Mengambil parameter sort dari query string, default ke 'asc' (ascending)
        $sortOrder = $request->get('sort', 'asc');

        // Mengambil data Jabatan dengan sorting berdasarkan nama_jabatan
        $jabatans = Jabatan::orderBy('nama_jabatan', $sortOrder)->get();

        // Mengirim data Jabatan dan urutan sort ke tampilan
        return view('pageadmin.datajabatan.index', compact('jabatans', 'sortOrder'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('pageadmin.datajabatan.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jabatan' => 'required|string|max:30|unique:jabatan,nama_jabatan',
        ], [
            'nama_jabatan.string' => 'Nama jabatan harus berupa teks.',
            'nama_jabatan.required' => 'Nama jabatan wajib diisi.',
            'nama_jabatan.unique' => 'Jabatan ":input" sudah terdaftar dalam database.',
            'nama_jabatan.max' => 'Nama jabatan tidak boleh melebihi 30 karakter.',
        ]);

        try {
            Jabatan::create([
                'nama_jabatan' => $validatedData['nama_jabatan'],
            ]);

            return redirect()->route('admin.datajabatan.index')->with('success', 'Data dosen berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    // Menampilkan detail data
    public function show($id)
    {
        return view('pageadmin.datajabatan.show', compact('id'));
    }

    // Menampilkan form edit data
    public function edit($id)
    {
        return view('pageadmin.datajabatan.edit', compact('id'));
    }

    // Memperbarui data
    public function update(Request $request, $id)
    {
        // Validasi dan update data
        return redirect()->route('pageadmin.datajabatan.index');
    }

    // Menghapus data
    public function destroy($id)
    {
        // Mencari data berdasarkan ID
        $jabatan = Jabatan::find($id);

        // Cek apakah data ditemukan
        if (!$jabatan) {
            return redirect()->route('admin.datajabatan.index')->with('error', 'Data Jabatan tidak ditemukan.');
        }

        // Menghapus data
        $jabatan->delete();

        // Mengirimkan pesan sukses
        return redirect()->route('admin.datajabatan.index')->with('success', 'Data Jabatan berhasil dihapus!');
    }
}
