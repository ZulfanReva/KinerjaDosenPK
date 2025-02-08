<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class DataPeriodeController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = $request->get('sort', 'asc'); // Default asc jika tidak ada parameter

        // Ambil data periode dan urutkan berdasarkan nama_periode
        $periodes = Periode::orderBy('nama_periode', $sortOrder)->get();

        return view('pageadmin.dataperiode.index', compact('periodes', 'sortOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pageadmin.dataperiode.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required|array',
            'nama_periode.*' => 'required|string|max:30|unique:periode,nama_periode',
        ], [
            'nama_periode.*.required' => 'Semua kolom nama periode wajib diisi.',
            'nama_periode.*.string' => 'Nama periode harus berupa teks.',
            'nama_periode.*.unique' => 'Periode ":input" sudah terdaftar dalam database.',
            'nama_periode.*.max' => 'Nama periode tidak boleh melebihi 30 karakter.',
        ]);

        try {
            foreach ($request->nama_periode as $namaPeriode) {
                Periode::create([
                    'nama_periode' => $namaPeriode,
                ]);
            }

            return redirect()->route('admin.dataperiode.index')->with('success', 'Data periode berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    // Menghapus data
    public function destroy($id)
    {
        // Mencari data berdasarkan ID
        $periode = Periode::find($id);

        // Cek apakah data ditemukan
        if (!$periode) {
            return redirect()->route('admin.dataperiode.index')->with('error', 'Data periode tidak ditemukan.');
        }

        // Menghapus data
        $periode->delete();

        // Mengirimkan pesan sukses
        return redirect()->route('admin.dataperiode.index')->with('success', 'Data periode berhasil dihapus!');
    }
}
