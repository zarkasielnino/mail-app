<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard'); // Buat file resources/views/admin/dashboard.blade.php
    }
    public function suratmasuk()
    {
        return view('admin.surat-masuk'); // Buat file resources/views/admin/dashboard.blade.php
    }
    public function suratkeluar()
    {
        return view('admin.surat-keluar'); // Buat file resources/views/admin/dashboard.blade.php
    }
    public function arsip()
    {
        return view('admin.arsip'); // Buat file resources/views/admin/dashboard.blade.php
    }
    public function template()
    {
        return view('admin.template'); // Buat file resources/views/admin/dashboard.blade.php
    }
    public function profile()
    {
        return view('admin.profile'); // Profil admin
    }

    public function pengaturan()
    {
        return view('admin.pengaturan'); // Pengaturan akun/admin
    }

    // Tambahkan method lain sesuai kebutuhan
}

