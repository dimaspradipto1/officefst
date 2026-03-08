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
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.index') }}">Mahasiswa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit Mahasiswa</h1>
                <p class="mb-0">Perbarui informasi data mahasiswa yang ada di bawah ini.</p>
            </div>
            <div>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <div class="col-lg-6 col-sm-12">
                                <!-- Form Nama -->
                                <div class="mb-4">
                                    <label for="name">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap"
                                            required>
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
                                            value="{{ old('email', $user->email) }}" placeholder="npm@uis.ac.id" required>
                                        @error('email')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
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
                                        value="{{ old('npm', $user->npm) }}"
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
                                        <option value="-" {{ old('prodi', $user->prodi) == '-' ? 'selected' : '' }}>
                                            pilih prodi
                                        </option>
                                        <option value="Teknik Industri"
                                            {{ old('prodi', $user->prodi) == 'Teknik Industri' ? 'selected' : '' }}>
                                            Teknik Industri</option>
                                        <option value="Teknik Informatika"
                                            {{ old('prodi', $user->prodi) == 'Teknik Informatika' ? 'selected' : '' }}>
                                            Teknik Informatika</option>
                                        <option value="Sistem Informasi"
                                            {{ old('prodi', $user->prodi) == 'Sistem Informasi' ? 'selected' : '' }}>
                                            Sistem Informasi</option>
                                        <option value="Teknik Perkapalan"
                                            {{ old('prodi', $user->prodi) == 'Teknik Perkapalan' ? 'selected' : '' }}>
                                            Teknik Perkapalan</option>
                                        <option value="Teknik Logistik"
                                            {{ old('prodi', $user->prodi) == 'Teknik Logistik' ? 'selected' : '' }}>
                                            Teknik Logistik</option>
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
                                        value="{{ old('nohp', $user->nohp) }}" placeholder="Contoh: 081234567890">
                                    @error('nohp')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Update Data</button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-danger mt-2 ms-2">Kembali</a>
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
                var input = $(this).siblings('input');
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
