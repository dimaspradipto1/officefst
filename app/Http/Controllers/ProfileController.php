<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $mahasiswa = null;

        if ($user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        }

        return view('pages.profile.index', compact('user', 'mahasiswa'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nohp'  => 'nullable|string|max:20',
        ];

        if ($user->role === 'mahasiswa') {
            $rules['npm'] = 'required|string|max:50';
            $rules['prodi'] = 'required|string|max:100';
        }

        $request->validate($rules);

        $userData = [
            'name'  => $request->name,
            'email' => $request->email,
            'nohp'  => $request->nohp,
        ];

        if ($user->role === 'mahasiswa') {
            $userData['npm'] = $request->npm;
            $userData['prodi'] = $request->prodi;
        }

        $user->fill($userData);
        $user->save();

        if ($user->role === 'mahasiswa') {
            Mahasiswa::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name'  => $request->name,
                    'email' => $request->email,
                    'nohp'  => $request->nohp,
                    'npm'   => $request->npm,
                    'prodi' => $request->prodi,
                ]
            );
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password'         => 'required|string|min:8|confirmed',
        ], [
            'current_password.current_password' => 'Password saat ini salah.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            if ($file->isValid()) {
                // Hapus foto lama jika ada
                if (!empty($user->profile_photo_path)) {
                    $oldPath = storage_path('app/public/' . $user->profile_photo_path);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // Generate nama file unik
                $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                $targetDir = storage_path('app/public/profile-photos');

                // Pastikan direktori tujuan ada
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                // Pindahkan file secara manual (lebih aman di Windows/Laragon)
                if ($file->move($targetDir, $filename)) {
                    $path = 'profile-photos/' . $filename;
                    $user->profile_photo_path = $path;
                    $user->save();
                    return back()->with('success', 'Foto profil berhasil diperbarui.');
                }
            }
        }

        return back()->with('error', 'Gagal mengunggah foto profil. Pastikan file valid.');
    }
}
