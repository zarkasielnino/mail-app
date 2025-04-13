<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('user.dashboard');  
    }

    // Surat Masuk
    public function suratMasuk()
    {
        return view('user.surat-masuk'); 
    }

    // Surat Keluar
    public function suratKeluar()
    {
        return view('user.surat-keluar'); 
    }

    // Buat Surat
    public function buatSurat()
    {
        return view('user.buat-surat');  
    }

    // Arsip Surat
    public function arsip()
    {
        return view('user.arsip');  
    }

    // Profil
    public function profil()
    {
        return view('profil');  
    }

    // Pengaturan (Settings)
    public function pengaturan()
    {
        return view('pengaturan'); 
    }

    // Logout
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('login');  // Redirect to login after logout
    }
    
}
