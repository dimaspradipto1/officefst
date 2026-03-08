<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // ─────────────────────────────────────────
    //  LOGIN
    // ─────────────────────────────────────────

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // ─────────────────────────────────────────
    //  REGISTER
    // ─────────────────────────────────────────

    public function registerForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.regiser');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email', 'unique:users,email'],
            'nama'     => ['required', 'string', 'max:255'],
            'npm'      => ['required', 'string', 'max:50', 'unique:users,npm'],
            'nohp'     => ['required', 'string', 'max:20'],
            'prodi'    => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.required'     => 'Email UIS wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email ini sudah terdaftar.',
            'nama.required'      => 'Nama mahasiswa wajib diisi.',
            'npm.required'       => 'NPM mahasiswa wajib diisi.',
            'npm.unique'         => 'NPM ini sudah terdaftar.',
            'nohp.required'      => 'Nomor HP wajib diisi.',
            'prodi.required'     => 'Program studi wajib dipilih.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name'     => $request->nama,
            'email'    => $request->email,
            'npm'      => $request->npm,
            'nohp'     => $request->nohp,
            'prodi'    => $request->prodi,
            'password' => Hash::make($request->password),
            'role'     => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'npm'     => $request->npm,
            'name'    => $request->nama,
            'email'   => $request->email,
            'nohp'    => $request->nohp,
            'prodi'   => $request->prodi,
        ]);



        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Akun berhasil dibuat. Selamat datang, ' . $user->name . '!');
    }
}
