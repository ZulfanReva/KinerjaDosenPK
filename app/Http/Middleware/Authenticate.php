<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('masuk'); // Arahkan ke halaman login jika belum login
        }

        $user = Auth::user();

        // Cek apakah user memiliki role yang sesuai
        if (in_array($user->role, $roles)) {
            return $next($request); // Lanjutkan jika role sesuai
        }

        // Jika tidak sesuai, kembalikan 403
        return abort(403, 'Unauthorized access');
    }
}