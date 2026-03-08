<?php

namespace App\Http\Controllers;

use App\DataTables\MahasiswaDataTable;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Http\Requests\MahasiswaRequest;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MahasiswaDataTable $dataTable)
    {
        return $dataTable->render('pages.mahasiswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MahasiswaRequest $request)
    {
        // Validation is handled by MahasiswaRequest

        // Create User first
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->npm), // Default password is NPM
            'npm'       => $request->npm,
            'prodi'     => $request->prodi,
            'nohp'      => $request->nohp,
            'role'      => 'mahasiswa',
            'is_aktive' => 1,
        ]);

        // Create Mahasiswa linked to User
        Mahasiswa::create([
            'user_id' => $user->id,
            'npm'     => $request->npm,
            'name'    => $request->name,
            'email'   => $request->email,
            'nohp'    => $request->nohp,
            'prodi'   => $request->prodi,
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $user = $mahasiswa->user;
        return view('pages.mahasiswa.edit', compact('mahasiswa', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        // Validation is handled by MahasiswaRequest

        // Update User
        $user = $mahasiswa->user;
        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'npm'       => $request->npm,
            'prodi'     => $request->prodi,
            'nohp'      => $request->nohp,
        ]);

        // Update Mahasiswa
        $mahasiswa->update([
            'npm'   => $request->npm,
            'name'  => $request->name,
            'email' => $request->email,
            'nohp'  => $request->nohp,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
