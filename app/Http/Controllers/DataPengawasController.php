<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pengawas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class DataPengawasController extends Controller
{
    // Menampilkan daftar data pengawas
    public function index()
    {
        $pengawas = Pengawas::with(['user', 'jabatan'])->get();
        
        // Debugging
        // if ($pengawas->isEmpty()) {
        //     dd('No pengawas found.');
        // } else {
        //     dd($pengawas);
        // }

        return view('pageadmin.datapengawas.index', compact('pengawas'));
    }

    // Menampilkan form tambah data pengawas
    public function create()
    {
        // Mengambil data jabatan dan users untuk dipilih di form
        $users = User::all(); // Ambil semua data pengguna
        $jabatans = Jabatan::all(); // Ambil semua data jabatan
        
        return view('pageadmin.datapengawas.create', compact('users', 'jabatans'));
    }

    // Menyimpan data pengawas baru
    public function store(Request $request)
{
    // Validasi data
    $validatedData = $request->validate([
        'nama_pengawas' => 'required|string|max:255',
        'jabatan_id' => 'required|exists:jabatan,id',
        'username' => 'required|string|unique:users,username',
        'password' => 'required|string|min:8',
    ]);

    // Buat pengguna baru
    $user = User::create([
        'username' => $validatedData['username'],
        'password' => bcrypt($validatedData['password']),
        'role' => 'pengawas',
    ]);

    // dd($user->id);

    // Simpan data pengawas
    Pengawas::create([
        'nama_pengawas' => $validatedData['nama_pengawas'],
        'jabatan_id' => $validatedData['jabatan_id'],
        'user_id' => $user->id, // Pastikan user_id diisi
    ]);

    return redirect()->route('admin.datapengawas.index')->with('success', 'Pengawas berhasil ditambahkan.');
}

    // Menampilkan detail data pengawas
    public function show($id)
    {
        $pengawas = Pengawas::with(['user', 'jabatan'])->findOrFail($id);
        return view('pageadmin.datapengawas.show', compact('pengawas'));
    }

    // Menampilkan form edit data pengawas
    public function edit($id)
    {
        $pengawas = Pengawas::findOrFail($id);
        $jabatans = Jabatan::all(); // Mengambil semua data pengawas
        return view('pageadmin.datapengawas.edit', compact('pengawas', 'jabatans'));
    }

    // Memperbarui data dosen
    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama_pengawas' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatan,id',
        ]);
        
        try {
            // Cari dosen berdasarkan ID
            $pengawas = Pengawas::findOrFail($id);

            // Update data dosen
            $pengawas->update([
                'nama_pengawas' => $validatedData['nama_pengawas'],
                'jabatan_id' => $validatedData['jabatan_id'],
            ]);

            // Mengembalikan respons sukses
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            // Menangani kesalahan dan mengembalikan error
            return response()->json(['success' => false, 'message' => 'Gagal mengupdate data: ' . $e->getMessage()]);
        }
    }

    // Menghapus data pengawas
    public function destroy($id)
    {
        // Mencari data berdasarkan ID
        $pengawas = Pengawas::find($id);

        // Cek apakah data ditemukan
        if (!$pengawas) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pengawas tidak ditemukan.'
            ], 404);  // Mengembalikan error 404 jika data tidak ditemukan
        }

        // Menghapus data
        $pengawas->delete();

        // Mengirimkan pesan sukses dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Pengawas berhasil dihapus!'
        ]);
    }
}