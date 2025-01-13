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
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Periksa apakah objek $user valid
        if (!$user || !$user instanceof \App\Models\User) {
            return back()->with('error', 'Terjadi kesalahan autentikasi. Silakan login ulang.');
        }

        // Periksa apakah kata sandi saat ini cocok
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini salah.']);
        }

        // Perbarui kata sandi
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Kirim pesan sukses ke session
        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui.');
    }
}
