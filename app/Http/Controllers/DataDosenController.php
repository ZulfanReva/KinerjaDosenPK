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

        // Pisahkan dosen pengajar dan dosen berjabatan
        $dosenPengajar = $dosens->filter(function ($dosen) {
            return $dosen->jabatan->nama_jabatan == 'Dosen Pengajar';
        });

        $dosenBerjabatan = $dosens->filter(function ($dosen) {
            return $dosen->jabatan->nama_jabatan != 'Dosen Pengajar';
        });

        // Ambil daftar Prodi untuk dropdown di filter
        $listProdi = Prodi::all();

        return view('pageadmin.datadosen.index', compact('dosenPengajar', 'dosenBerjabatan', 'listProdi'));
    }

    public function filter(Request $request)
    {
        // Filter untuk Dosen Pengajar
        $queryPengajar = Dosen::with('prodi', 'jabatan', 'user');
        if ($request->prodi) {
            $queryPengajar->where('prodi_id', $request->prodi);
        }
        if ($request->status) {
            $queryPengajar->where('status', $request->status);
        }
        $dosenPengajar = $queryPengajar->whereHas('jabatan', function ($query) {
            $query->where('nama_jabatan', 'Dosen Pengajar');
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
            $query->where('nama_jabatan', '!=', 'Dosen Pengajar');
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
            'nama_dosen.*' => 'required|string|max:255',
            'nidn.*' => 'required|string|max:255|unique:dosen,nidn',
            'prodi_id.*' => 'required|integer|exists:prodi,id',
            'status.*' => 'required|in:Aktif,Nonaktif',
            'jabatan_id.*' => 'required|integer|exists:jabatan,id',
            'username.*' => 'nullable|max:50|unique:users,username',
            'password.*' => 'nullable|string|min:8',
        ]);

        try {
            foreach ($request->nama_dosen as $key => $namaDosen) {
                $jabatan = Jabatan::find($request->jabatan_id[$key]);

                if ($jabatan->nama_jabatan !== 'Dosen Pengajar') {
                    if (empty($request->username[$key]) || empty($request->password[$key])) {
                        return back()->withErrors(['error' => "Username dan Password wajib diisi untuk dosen dengan jabatan selain 'Dosen Pengajar'."]);
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
        $validatedData = $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nidn' => 'required|string|max:20|unique:dosen,nidn,' . $id,
            'prodi_id' => 'required|exists:prodi,id',
            'status' => 'required|in:Aktif,Nonaktif',
            'jabatan_id' => 'required|exists:jabatan,id',
            'username' => 'nullable|max:50|unique:users,username,' . optional(Dosen::find($id)->user)->id,
            'password' => 'nullable|string|min:8',
        ]);

        try {
            DB::beginTransaction();

            $dosen = Dosen::findOrFail($id);
            $jabatan = Jabatan::find($request->jabatan_id);

            if ($jabatan->nama_jabatan === 'Dosen Pengajar') {
                if ($dosen->user) {
                    $dosen->user->delete();
                }
                $dosen->users_id = null;
            } else {
                if ($dosen->user) {
                    if ($request->filled('username')) {
                        $dosen->user->username = $request->username;
                    }
                    if ($request->filled('password')) {
                        $dosen->user->password = Hash::make($request->password);
                    }
                    $dosen->user->save();
                } else {
                    if (!$request->filled('username') || !$request->filled('password')) {
                        throw new \Exception("Username dan Password wajib diisi untuk dosen dengan jabatan selain 'Dosen Pengajar'.");
                    }
                    $user = User::create([
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'role' => 'dosenberjabatan',
                    ]);
                    $dosen->users_id = $user->id;
                }
            }

            $dosen->update([
                'nama_dosen' => $validatedData['nama_dosen'],
                'nidn' => $validatedData['nidn'],
                'prodi_id' => $validatedData['prodi_id'],
                'status' => $validatedData['status'],
                'jabatan_id' => $validatedData['jabatan_id'],
            ]);

            DB::commit();
            return redirect()->route('admin.datadosen.index')->with('success', 'Data dosen berhasil diubah.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
