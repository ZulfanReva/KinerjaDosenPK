<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        return view('index');  // Sesuaikan dengan nama view yang Anda gunakan untuk halaman beranda
    }
}

