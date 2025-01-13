<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfilAdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return view('pageadmin.profiladmin', compact('user'));
    }

    public function checkPassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
            ]);

            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'valid' => false,
                    'message' => 'User tidak ditemukan'
                ], 401);
            }

            $isValid = Hash::check($request->current_password, $user->password);
            return response()->json([
                'valid' => $isValid,
                'message' => $isValid ? 'Password valid' : 'Password tidak valid'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'valid' => false,
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'valid' => false,
                'message' => 'Terjadi kesalahan server'
            ], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed|different:current_password',
            ]);

            $user = Auth::user();
            if (!$user || !$user instanceof User) {
                throw new \Exception('Terjadi kesalahan autentikasi. Silakan login ulang.');
            }

            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['Kata sandi saat ini salah.']
                ]);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kata sandi berhasil diperbarui'
                ]);
            }

            return back()->with('success', 'Kata sandi berhasil diperbarui.');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }
            return back()->with('error', $e->getMessage());
        }
    }
}
