<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');  // Sesuaikan dengan nama view yang Anda gunakan untuk halaman kontak
    }
}