<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('user.dashboard');  // Make sure you have a dashboard.blade.php view
    }

    // Surat Masuk
    public function suratMasuk()
    {
        return view('user.surat-masuk');  // Make sure you have a surat-masuk.blade.php view
    }

    // Surat Keluar
    public function suratKeluar()
    {
        return view('user.surat-keluar');  // Make sure you have a surat-keluar.blade.php view
    }

    // Buat Surat
    public function buatSurat()
    {
        return view('user.buat-surat');  // Make sure you have a buat-surat.blade.php view
    }

    // Arsip Surat
    public function arsip()
    {
        return view('user.arsip');  // Make sure you have an arsip.blade.php view
    }

    // Profil
    public function profil()
    {
        return view('profil');  // Make sure you have a profil.blade.php view
    }

    // Pengaturan (Settings)
    public function pengaturan()
    {
        return view('pengaturan');  // Make sure you have a pengaturan.blade.php view
    }

    // Logout
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('login');  // Redirect to login after logout
    }
}
