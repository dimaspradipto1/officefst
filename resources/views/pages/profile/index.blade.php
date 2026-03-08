@extends('pages.dashboard.template')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Profil Saya</h1>
            <p class="mb-0">Manajemen data diri dan informasi akademik Anda.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">Informasi Profil</h2>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Nama Lengkap</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                type="text" placeholder="Masukkan nama lengkap" value="{{ old('name', $user->name) }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Alamat Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                type="email" placeholder="name@company.com" value="{{ old('email', $user->email) }}"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="npm">NPM / Nomor Induk</label>
                            <input class="form-control @error('npm') is-invalid @enderror" id="npm" name="npm"
                                type="text" placeholder="Masukkan NPM" value="{{ old('npm', $user->npm) }}"
                                {{ $user->role !== 'mahasiswa' ? 'readonly' : '' }}>
                            @error('npm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nohp">Nomor Handphone</label>
                            <input class="form-control @error('nohp') is-invalid @enderror" id="nohp" name="nohp"
                                type="text" placeholder="0821xxxx" value="{{ old('nohp', $user->nohp) }}">
                            @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @if ($user->role === 'mahasiswa')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="prodi">Program Studi</label>
                                <select class="form-select @error('prodi') is-invalid @enderror" id="prodi"
                                    name="prodi">
                                    <option value="">Pilih Program Studi</option>
                                    <option value="Teknik Informatika"
                                        {{ old('prodi', $user->prodi) == 'Teknik Informatika' ? 'selected' : '' }}>Teknik
                                        Informatika</option>
                                    <option value="Sistem Informasi"
                                        {{ old('prodi', $user->prodi) == 'Sistem Informasi' ? 'selected' : '' }}>Sistem
                                        Informasi</option>
                                    <option value="Teknik Industri"
                                        {{ old('prodi', $user->prodi) == 'Teknik Industri' ? 'selected' : '' }}>Teknik
                                        Industri</option>
                                </select>
                                @error('prodi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="prodi">Unit / Prodi</label>
                                <input class="form-control" id="prodi" type="text" value="{{ $user->prodi }}"
                                    readonly disabled>
                            </div>
                        </div>
                    @endif
                    <div class="mt-3">
                        <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="row">
                <div class="col-12">
                    <div class="card card-body border-0 shadow mb-4 text-center">
                        <h2 class="h5 mb-4">Informasi Akun</h2>
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="avatar-lg">
                                @if ($user->profile_photo_path)
                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                        class="rounded-circle shadow" alt="Profile image"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                @else
                                    <div class="avatar-lg bg-gray-200 rounded-circle d-flex align-items-center justify-content-center border border-gray-300"
                                        style="width: 100px; height: 100px;">
                                        <i class="fa-solid fa-user-tie fa-3x text-gray-500"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="h6 mb-1">{{ $user->name }}</h3>
                            <span class="badge bg-primary">{{ strtoupper($user->role) }}</span>
                        </div>

                        <form action="{{ route('profile.upload-photo') }}" method="POST" enctype="multipart/form-data"
                            class="mt-3">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control form-control-sm @error('profile_photo') is-invalid @enderror"
                                    id="profile_photo" name="profile_photo" type="file" accept="image/*">
                                @error('profile_photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-sm btn-outline-gray-800" type="submit">Update Foto</button>
                        </form>

                        <div class="small text-gray-400 mt-3 border-top pt-2">
                            Username: {{ $user->npm }}
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">Keamanan Akun</h2>
                        <form action="{{ route('profile.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="current_password">Password Sekarang</label>
                                    <input class="form-control @error('current_password') is-invalid @enderror"
                                        id="current_password" name="current_password" type="password" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="password">Password Baru</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="password"
                                        name="password" type="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="password_confirmation">Ulangi Password Baru</label>
                                    <input class="form-control" id="password_confirmation" name="password_confirmation"
                                        type="password" required>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-gray-800 mt-2 animate-up-2 w-100" type="submit">Update
                                    Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
