@extends('pages.dashboard.template')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Tambah Pengguna Baru</h1>
                <p class="mb-0">Silakan isi formulir di bawah ini untuk menambahkan pengguna baru ke dalam sistem.</p>
            </div>
            <div>
                <a href="{{ route('users.index') }}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-6 col-sm-12">
                                <!-- Form Nama -->
                                <div class="mb-4">
                                    <label for="name">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                                        @error('name')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form Email -->
                                <div class="mb-4">
                                    <label for="email">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            value="{{ old('email') }}" placeholder="npm@uis.ac.id" required>
                                        @error('email')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form Password -->
                                <div class="mb-4">
                                    <label for="password">Password</label>
                                    <div class="input-group has-validation">
                                        <button class="input-group-text toggle-password" type="button">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="Masukkan password" required>
                                        @error('password')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form Role -->
                                <div class="mb-4">
                                    <label for="role">Role / Peran</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-id-badge"></i></span>
                                        <select class="form-select @error('role') is-invalid @enderror" id="role"
                                            name="role" required>
                                            <option value="" selected disabled>Pilih Role</option>
                                            <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>
                                                Super Admin</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="dekan" {{ old('role') == 'dekan' ? 'selected' : '' }}>Dekan
                                            </option>
                                            <option value="wakil_dekan_I"
                                                {{ old('role') == 'wakil_dekan_I' ? 'selected' : '' }}>Wakil Dekan I
                                            </option>
                                            <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>
                                                Mahasiswa</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <!-- Form NPM -->
                                <div class="mb-4">
                                    <label for="npm">NPM (Nomor Pokok Mahasiswa) atau NUP</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                        <input type="text" name="npm"
                                            class="form-control @error('npm') is-invalid @enderror" id="npm"
                                            value="{{ old('npm') }}"
                                            placeholder="Contoh: 210101001 atau 'NUP' jika bukan mahasiswa">
                                        @error('npm')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form Prodi -->
                                <div class="mb-4">
                                    <label for="prodi">Program Studi</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-graduation-cap"></i></span>
                                        <select class="form-select @error('prodi') is-invalid @enderror" id="prodi"
                                            name="prodi">
                                            <option value="-" selected {{ old('prodi') == '-' ? 'selected' : '' }}>
                                                pilih prodi</option>
                                            <option value="Teknik Industri"
                                                {{ old('prodi') == 'Teknik Industri' ? 'selected' : '' }}>Teknik Industri
                                            </option>
                                            <option value="Teknik Informatika"
                                                {{ old('prodi') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik
                                                Informatika</option>
                                            <option value="Sistem Informasi"
                                                {{ old('prodi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi
                                            </option>
                                            <option value="Teknik Perkapalan"
                                                {{ old('prodi') == 'Teknik Perkapalan' ? 'selected' : '' }}>Teknik
                                                Perkapalan</option>
                                            <option value="Teknik Logistik"
                                                {{ old('prodi') == 'Teknik Logistik' ? 'selected' : '' }}>Teknik Logistik
                                            </option>
                                        </select>
                                        @error('prodi')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form No HP -->
                                <div class="mb-4">
                                    <label for="nohp">Nomor WhatsApp / HP</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                        <input type="text" name="nohp"
                                            class="form-control @error('nohp') is-invalid @enderror" id="nohp"
                                            value="{{ old('nohp') }}" placeholder="Contoh: 081234567890">
                                        @error('nohp')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- is_aktive Switch -->
                                <div class="mb-4 mt-2">
                                    <label class="d-block mb-2">Status Akun</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_aktive" id="is_aktive"
                                            value="1" {{ old('is_aktive', '1') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_aktive">Aktifkan Akun</label>
                                    </div>
                                    <small class="text-muted">Jika diaktifkan, pengguna dapat masuk ke aplikasi.</small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Simpan Data</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger mt-2 ms-2">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.toggle-password').click(function() {
                var input = $(this).parent().find('input');
                var icon = $(this).find('i');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
@endpush
