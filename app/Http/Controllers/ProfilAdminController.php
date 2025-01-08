<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilAdminController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        return view('pageadmin.profiladmin', compact('user')); // Mengirim data ke view
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Periksa apakah objek $user adalah instance dari User
        if (!$user instanceof \App\Models\User) {
            return back()->withErrors(['user' => 'Terjadi kesalahan autentikasi.']);
        }

        // Periksa apakah kata sandi saat ini benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini salah.']);
        }

        // Perbarui kata sandi dan simpan
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui.');
    }
}