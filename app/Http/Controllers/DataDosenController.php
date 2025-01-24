<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DataDosenController extends Controller
{
    public function index()
    {
        // Ambil semua data dosen dengan relasi 'prodi', 'jabatan', 'user'
        $dosens = Dosen::with('prodi', 'jabatan', 'user')->get();

        // Pisahkan DOSEN PENGAJAR dan dosen berjabatan
        $dosenPengajar = $dosens->filter(function ($dosen) {
            return $dosen->jabatan->nama_jabatan == 'DOSEN PENGAJAR';
        });

        $dosenBerjabatan = $dosens->filter(function ($dosen) {
            return $dosen->jabatan->nama_jabatan != 'DOSEN PENGAJAR';
        });

        // Ambil daftar Prodi untuk dropdown di filter
        $listProdi = Prodi::all();

        return view('pageadmin.datadosen.index', compact('dosenPengajar', 'dosenBerjabatan', 'listProdi'));
    }

    public function filter(Request $request)
    {
        // Filter untuk DOSEN PENGAJAR
        $queryPengajar = Dosen::with('prodi', 'jabatan', 'user');
        if ($request->prodi) {
            $queryPengajar->where('prodi_id', $request->prodi);
        }
        if ($request->status) {
            $queryPengajar->where('status', $request->status);
        }
        $dosenPengajar = $queryPengajar->whereHas('jabatan', function ($query) {
            $query->where('nama_jabatan', 'DOSEN PENGAJAR');
        })->get();

        // Filter untuk Dosen Berjabatan
        $queryBerjabatan = Dosen::with('prodi', 'jabatan', 'user');
        if ($request->prodi) {
            $queryBerjabatan->where('prodi_id', $request->prodi);
        }
        if ($request->status) {
            $queryBerjabatan->where('status', $request->status);
        }
        $dosenBerjabatan = $queryBerjabatan->whereHas('jabatan', function ($query) {
            $query->where('nama_jabatan', '!=', 'DOSEN PENGAJAR');
        })->get();

        // Ambil daftar Prodi untuk dropdown di filter
        $listProdi = Prodi::all();

        return view('pageadmin.datadosen.index', compact('dosenPengajar', 'dosenBerjabatan', 'listProdi'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        $jabatans = Jabatan::all();
        return view('pageadmin.datadosen.create', compact('prodis', 'jabatans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_dosen.*' => 'required|string|max:255|unique:dosen,nama_dosen',
            'nidn.*' => 'required|string|max:255|unique:dosen,nidn',
            'prodi_id.*' => 'required|integer|exists:prodi,id',
            'status.*' => 'required|in:Aktif,Nonaktif',
            'jabatan_id.*' => 'required|integer|exists:jabatan,id',
            'username.*' => 'nullable|max:50|unique:users,username',
            'password.*' => 'nullable|string|min:8',
        ], [
            // Custom messages for nama_dosen
            'nama_dosen.*.required' => 'Nama dosen wajib diisi.',
            'nama_dosen.*.string' => 'Nama dosen harus berupa teks.',
            'nama_dosen.*.unique' => 'Nama Dosen ":input" sudah terdaftar di database.',

            // Custom messages for nidn
            'nidn.*.required' => 'NIDN wajib diisi.',
            'nidn.*.unique' => 'NIDN ":input" sudah terdaftar di database.',

            // Custom messages for prodi_id
            'prodi_id.*.required' => 'Prodi wajib diisi.',

            // Custom messages for status
            'status.*.required' => 'Status wajib diisi.',

            // Custom messages for jabatan_id
            'jabatan_id.*.required' => 'Jabatan wajib diisi.',

            // Custom messages for username
            'username.*.max' => 'Username tidak boleh lebih dari 50 karakter.',
            'username.*.unique' => 'Username ":input" sudah terdaftar di database.',

            // Custom messages for password
            'password.*.string' => 'Password harus berupa teks.',
            'password.*.min' => 'Password minimal harus terdiri dari 8 karakter.',
        ]);


        try {
            foreach ($request->nama_dosen as $key => $namaDosen) {
                $jabatan = Jabatan::find($request->jabatan_id[$key]);

                if ($jabatan->nama_jabatan !== 'DOSEN PENGAJAR') {
                    if (empty($request->username[$key]) || empty($request->password[$key])) {
                        return back()->withErrors(['error' => "Username dan Password wajib diisi untuk dosen dengan jabatan selain 'DOSEN PENGAJAR'."]);
                    }

                    $user = User::create([
                        'username' => $request->username[$key],
                        'password' => bcrypt($request->password[$key]),
                        'role' => 'dosenberjabatan',
                    ]);

                    Dosen::create([
                        'nama_dosen' => $namaDosen,
                        'nidn' => $request->nidn[$key],
                        'prodi_id' => $request->prodi_id[$key],
                        'status' => $request->status[$key],
                        'jabatan_id' => $request->jabatan_id[$key],
                        'users_id' => $user->id,
                    ]);
                } else {
                    Dosen::create([
                        'nama_dosen' => $namaDosen,
                        'nidn' => $request->nidn[$key],
                        'prodi_id' => $request->prodi_id[$key],
                        'status' => $request->status[$key],
                        'jabatan_id' => $request->jabatan_id[$key],
                        'users_id' => null,
                    ]);
                }
            }

            return redirect()->route('admin.datadosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $dosen = Dosen::with('user')->findOrFail($id);
        $prodis = Prodi::all();
        $jabatans = Jabatan::all();
        return view('pageadmin.datadosen.edit', compact('dosen', 'prodis', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nidn' => 'required|string|max:20',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        // Ambil data dosen berdasarkan ID
        $dosen = Dosen::findOrFail($id);

        // Update data dosen
        $dosen->update([
            'nama_dosen' => $request->nama_dosen,
            'nidn' => $request->nidn,
            'status' => $request->status,
        ]);

        // Update data user hanya jika dosen bukan "DOSEN PENGAJAR"
        if ($dosen->jabatan->nama_jabatan !== 'DOSEN PENGAJAR') {
            // Periksa apakah user terkait ada
            if ($dosen->user) {
                // Update user jika diperlukan
                $dosen->user->update([
                    'username' => $request->username ?? $dosen->user->username,
                    'password' => $request->password ? Hash::make($request->password) : $dosen->user->password,
                ]);
            } else {
                // Tambahkan logika untuk menangani jika user tidak ditemukan
                // Misalnya, buat user baru
            }
        }

        return redirect()->route('admin.datadosen.index')->with('success', 'Data Dosen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $dosen = Dosen::findOrFail($id);

            if ($dosen->user) {
                $dosen->user->delete();
            }

            $dosen->delete();

            DB::commit();
            return redirect()->route('admin.datadosen.index')->with('success', 'Data dosen berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
