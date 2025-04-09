<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function update(Request $req) {
        try {
            $user = auth()->user();
    
            $user->username = $req->username;
            // Cek apakah ada file yang diunggah
            if ($req->hasFile('foto_profil')) {
                $oldFilePath = public_path('storage/profile_pictures/' . $user->foto_profil);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);  // Menghapus file lama
                }

                // Simpan foto baru
                $imageName = time() . '.' . $req->foto_profil->extension(); 
                $req->foto_profil->move(public_path('storage/profile_pictures'), $imageName);  // Menyimpan gambar di folder 'public/profile_pictures'

                // Simpan ke database
                $user->foto_profil = $imageName;  // Simpan nama gambar di database
                $user->save();  // Simpan perubahan user
            }
            $user->save();
    
            return redirect(route('profil'))->with('success', 'Profile updated successfully!');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.')->withInput();   
        }
    }

}
