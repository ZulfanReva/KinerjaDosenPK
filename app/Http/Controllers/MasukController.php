<?php


namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasukController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function index()
    {
        // Jika user sudah login, arahkan sesuai role-nya
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('pageadmin.berandaadmin');
            } elseif ($user->role == 'dosenberjabatan') {
                return redirect()->route('pagedosenberjabatan.berandadosenberjabatan');
            }
        }

        return view('masuk');
    }

    /**
     * Proses login pengguna.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Siapkan kredensial untuk autentikasi
        $credentials = $request->only('username', 'password');

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            // Redirect berdasarkan peran
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.beranda');
            } elseif (Auth::user()->role === 'dosenberjabatan') {
                return redirect()->route('dosenberjabatan.beranda');
            }
        }

        // Jika login gagal
        return redirect()->route('masuk')->with('error', 'Username atau kata sandi salah');
    }
    

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Hapus session dan kembalikan ke halaman login
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect()->route('index');
    }

    public function handle(Request $request, Closure $next, ...$roles)
    {
    // Cek apakah user sudah login
    if (Auth::check()) {
        // Redirect ke halaman admin.beranda jika sudah login
        return redirect()->route('admin.beranda');
    }

    // Jika belum login, arahkan ke halaman login
    return redirect()->route('masuk');
}
}