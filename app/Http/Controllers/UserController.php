<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function update(Request $req) {
        try {
            $user = auth()->user();
    
            $user->username = $req->username;
            // Cek apakah ada file yang diunggah
            if ($req->hasFile('foto_profil')) {
                if (!empty($user->foto_profil)) {
                    $oldFilePath = public_path('storage/profile_pictures/' . $user->foto_profil);
                    if (file_exists($oldFilePath) && is_file($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // Simpan foto baru
                $imageName = time() . '.' . $req->foto_profil->extension(); 
                $req->foto_profil->move(public_path('storage/profile_pictures'), $imageName);  // Menyimpan gambar di folder 'public/profile_pictures'

                // Simpan ke database
                $user->foto_profil = $imageName;  // Simpan nama gambar di database
                $user->save();  // Simpan perubahan user
            }
            $user->save();
    
            return redirect(route('profilPage'))->with('success', 'Profile updated successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.')->withInput();   
        }
    }

    public function deleteAkun(Request $request) {
        try {
            $user = auth()->user();

            if (!empty($user->foto_profil)) {
                $oldFilePath = public_path('storage/profile_pictures/' . $user->foto_profil);
                if (file_exists($oldFilePath) && is_file($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $images = Image::where('user_id', $user->id)->get();
            foreach ($images as $image) {
                $imagePath = public_path('storage/images/' . $image->filename); 
                if (file_exists($imagePath) && is_file($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $user->delete();

            return response()->json(['success' => true]); // Supaya bisa ditangani dari JS
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus akun'], 500);
        }
    }
}
