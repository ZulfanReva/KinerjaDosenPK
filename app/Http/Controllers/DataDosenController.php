<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class DataDosenController extends Controller
{
    // Menampilkan daftar data dosen
    public function index()
    {
        // Mengambil dosen dengan relasi Prodi dan Jabatan
        $dosens = Dosen::with('prodi', 'jabatan')->get();

        // Pisahkan dosen berdasarkan jabatan
        $dosenPengajar = $dosens->filter(function ($dosen) {
            return $dosen->jabatan->nama_jabatan == 'Dosen Pengajar';
        });

        $dosenBerjabatan = $dosens->filter(function ($dosen) {
            return $dosen->jabatan->nama_jabatan != 'Dosen Pengajar';
        });

        // Mengirimkan data ke view
        return view('pageadmin.datadosen.index', compact('dosenPengajar', 'dosenBerjabatan'));
    }


    // Menampilkan form tambah data dosen
    public function create()
    {
        // Mengambil semua data prodi
        $prodis = Prodi::all();
        $jabatans = Jabatan::all();

        // Mengirim data ke view
        return view('pageadmin.datadosen.create', compact('prodis', 'jabatans'));
    }

    // Menyimpan data dosen baru
    public function store(Request $request)
    {
        // Validasi input dosen
        $validatedData = $request->validate([
            'nama_dosen.*' => 'required|string|max:255',
            'nidn.*' => 'required|string|max:255|unique:dosen,nidn',
            'prodi_id.*' => 'required|integer|exists:prodi,id',
            'status.*' => 'required|in:Aktif,Nonaktif',
            'jabatan_id.*' => 'required|integer|exists:jabatan,id',
            'username.*' => 'nullable|max:50|unique:users,username', // Username hanya diperlukan untuk dosen non-pengajar
            'password.*' => 'nullable|string|min:8', // Password hanya diperlukan untuk dosen non-pengajar
        ]);

        foreach ($request->nama_dosen as $key => $namaDosen) {
            $nidn = $request->nidn[$key];
            $prodiId = $request->prodi_id[$key];
            $status = $request->status[$key];
            $jabatanId = $request->jabatan_id[$key];
            $username = $request->username[$key] ?? null; // Ambil username jika ada
            $password = $request->password[$key] ?? null; // Ambil password jika ada

            // Cek apakah jabatan bukan "Dosen Pengajar"
            $jabatan = Jabatan::find($jabatanId);
            $usersId = null;

            if ($jabatan && $jabatan->nama_jabatan !== 'Dosen Pengajar') {
                // Pastikan username dan password tersedia
                if (!empty($username) && !empty($password)) {
                    // Buat user untuk dosen non-pengajar
                    $user = User::create([
                        'username' => $username,
                        'password' => bcrypt($password), // Hash password dengan bcrypt
                        'role' => 'dosenjabatan', // Role khusus untuk dosen non-pengajar
                    ]);
                    $usersId = $user->id;
                } else {
                    // Kembali dengan error jika username atau password kosong
                    return back()->withErrors(['error' => "Username dan Password wajib diisi untuk dosen dengan jabatan selain 'Dosen Pengajar'."]);
                }
            }

            // Simpan data ke tabel dosen
            Dosen::create([
                'nama_dosen' => $namaDosen,
                'nidn' => $nidn,
                'prodi_id' => $prodiId,
                'status' => $status,
                'jabatan_id' => $jabatanId,
                'users_id' => $usersId, // Bisa null jika Dosen Pengajar
            ]);
        }

        return redirect()->route('admin.datadosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
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
