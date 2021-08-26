<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login'); // tampilkan halaman login
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]); // validasi login
        /**
         * !Expectation:
         * $credential = [
         *  'email' => 'emailanda@email.com',
         *  'password' => '123456'
         * ];
         */
        
        $user = User::where('email', $request->email)->first(); // mencari user dengan email
        if (!$user) { // jika user tidak ditemukan
            return back()->withErrors(['email' => 'Email tidak terdaftar.']); // kembali ke halaman login dengan pesan error
        }

        if (Auth::attempt($credentials)) { // jika Auth::attempt true (berhasil login)
            $request->session()->regenerate(); // generate session login
            return redirect()->intended('dashboard'); // redirect ke route dengan nama dashboard
        }
        
        return back()->withErrors(['password' => 'Password salah.', ]); // default redirect kembali ke halaman login dengan pesan error
    }

    public function registerForm() {
        return view('auth.register'); // tampilkan halaman registrasi
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required'
        ]); // validasi form registrasi
        /**
         * !Expectation:
         * $request = [
         *  'name' => 'Nama Anda',
         *  'email' => 'emailanda@email.com',
         *  'password' => '123456'
         * ];
         */

        $user = User::where('email', $request->email)->first(); // cari user dengan email
        if ($user) { // jika user ada
            return back()->withError('email', 'Email already registered'); // kembali ke halaman register, beri pesan error
        }

        $request['password'] = Hash::make($request->password); // reassign password pada request dengan Hashed password
        /**
         * !Expectation:
         * $request = [
         *  'name' => 'Nama Anda',
         *  'email' => 'emailanda@email.com',
         *  'password' => 'dh932r73gr3rgqwdh9w8r3ugr973vrywqegwqueit27egwe'
         * ];
         */

        $user = User::create($request->all()); // buat user
        return back()->with(['success' => 'Registrasi berhasil. Silahkan login.']); // redirect ke halaman login dengan pesan sukses
    }

    public function logout(Request $request)
    {
        Auth::logout(); // logging out
        $request->session()->invalidate(); // invalidate session pada browser
        $request->session()->regenerateToken(); // regenerate token
        return redirect('/'); // redirect ke home
    }
}
