<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    // Proses Login
    public function prosesLogin(Request $request)
    {
       $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('task');
        }
 
        return back()->withErrors([
            'email' => 'Akun kamu belum terdaftar!',
        ])->onlyInput('email');
    }

    // Registration
    public function registration()
    {
        return view('user.register');
    }


    public function prosesRegistration(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','email', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Membuat data user baru
        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'email_verified_at' => date('Y-m-d H:i:s', time())
        ]);

        return redirect()->route('login')->with('success','Registrasi Berhasil, silahkan Login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect()->route('login');
    }
}
