<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode; // Pastikan model Periode sudah dibuat

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua data periode dari database
        $periodes = Periode::all();
        return view('pageadmin.dataperiode.index', compact('periodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk membuat data periode baru
        return view('pageadmin.dataperiode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_periode' => 'required|array',
            'nama_periode.*' => 'required|string|max:255',
        ]);

        // Simpan data prodi
        foreach ($request->nama_periode as $namaPeriode) {
        Periode::create(['nama_periode' => $namaPeriode]);
        }

       // Setelah berhasil, redirect ke halaman daftar prodi
        return redirect()->route('admin.dataperiode.index')->with('success', 'Data Prodi berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail data periode berdasarkan ID
        $periode = Periode::findOrFail($id);
        return view('pageadmin.dataperiode.show', compact('periode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form edit data periode berdasarkan ID
        $periode = Periode::findOrFail($id);
        return view('pageadmin.dataperiode.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_periode' => 'required|string|max:255',
        ]);

        // Mengupdate data periode di database
        $periode = Periode::findOrFail($id);
        $periode->update($request->only('nama_periode'));

        return redirect()->route('dataperiode.index')->with('success', 'Data periode berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari data berdasarkan ID
        $periode = Periode::find($id);

        // Cek apakah data ditemukan
        if (!$periode) {
            return response()->json([
                'success' => false,
                'message' => 'Data Periode tidak ditemukan.'
            ], 404);  // Mengembalikan error 404 jika data tidak ditemukan
        }

        // Menghapus data
        $periode->delete();

        // Mengirimkan pesan sukses dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Periode berhasil dihapus!'
        ]);
    }
}