<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $req) 
    {
        try {
            $user = User::where('email', $req->email)->first();
            if (!$user || !Hash::check($req->password, $user->password)) {
                return back()->with('error', 'Email atau password tidak sesuai.')->withInput();
            }

            Auth::login($user);
           
            return redirect('/')->with('success', 'Login berhasil!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.')->withInput();   
        }
    }

    public function register(Request $req) 
    {
        try {
            $data = $req->all();
            if ($data['password'] !== $data['confirmpassword']) {
                return back()->with('error', 'Password tidak sesuai, silakan coba lagi.');
            }
            
            $data['password'] = bcrypt($data['password']);

            User::create([
                "username" => $data['username'],
                "password" => $data['password'],
                "email" => $data['email']
            ]);

            return redirect(route('loginPage'))->with('success', 'Registrasi berhasil! Silakan login.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal melakukan registrasi.')->withInput();
        }
    }
}
