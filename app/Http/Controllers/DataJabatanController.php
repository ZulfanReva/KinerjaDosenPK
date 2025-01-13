<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class DataJabatanController extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        // Mengambil semua data Jabatan
        $jabatans = Jabatan::all();

        // Mengirim data Jabatan ke tampilan
        return view('pageadmin.datajabatan.index', compact('jabatans'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('pageadmin.datajabatan.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_jabatan' => 'required|array',
            'nama_jabatan.*' => 'required|string|max:255',
        ]);

        // Simpan data jabatan
        foreach ($request->nama_jabatan as $namaJabatan) {
            Jabatan::create(['nama_jabatan' => $namaJabatan]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('admin.datajabatan.index')
            ->with('success', 'Data Jabatan berhasil ditambah!');
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
