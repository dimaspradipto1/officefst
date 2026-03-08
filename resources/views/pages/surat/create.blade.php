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
                <li class="breadcrumb-item"><a href="{{ route('surat.index') }}">Pengajuan Surat</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Tambah Pengajuan Surat</h1>
                <p class="mb-0">Silakan isi formulir di bawah ini untuk mengajukan surat baru.</p>
            </div>
            <div>
                <a href="{{ route('surat.index') }}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <form action="{{ route('surat.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-6 col-sm-12">
                                <!-- Jenis Surat -->
                                <div class="mb-4">
                                    <label for="jenis_surat">Jenis Surat</label>
                                    <select class="form-select @error('jenis_surat') is-invalid @enderror" id="jenis_surat"
                                        name="jenis_surat" required>
                                        <option value="" selected disabled>Pilih Jenis Surat</option>
                                        <option value="surat kp"
                                            {{ request('type') == 'kp' || old('jenis_surat') == 'surat kp' ? 'selected' : '' }}>
                                            Surat Kerja Praktek (KP)</option>
                                        <option value="surat penelitian"
                                            {{ request('type') == 'penelitian' || old('jenis_surat') == 'surat penelitian' ? 'selected' : '' }}>
                                            Surat Izin
                                            Penelitian</option>
                                    </select>
                                    @error('jenis_surat')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Judul Penelitian (Conditional) -->
                                <div class="mb-4 d-none" id="judul_penelitian_container">
                                    <label for="judul_penelitian">Judul Penelitian</label>
                                    <textarea name="judul_penelitian" class="form-control @error('judul_penelitian') is-invalid @enderror"
                                        id="judul_penelitian" placeholder="Masukkan judul penelitian">{{ old('judul_penelitian') }}</textarea>
                                    @error('judul_penelitian')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tujuan / Jabatan -->
                                <div class="mb-4">
                                    <label for="tujuan">Tujuan (Jabatan Penerima)</label>
                                    <input type="text" name="tujuan"
                                        class="form-control @error('tujuan') is-invalid @enderror" id="tujuan"
                                        value="{{ old('tujuan') }}" placeholder="Contoh: HRD Manager" required>
                                    @error('tujuan')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <!-- Nama Perusahaan -->
                                <div class="mb-4">
                                    <label for="nama_perusahaan">Nama Perusahaan / Instansi</label>
                                    <input type="text" name="nama_perusahaan"
                                        class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                        id="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                                        placeholder="Masukkan nama perusahaan" required>
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Alamat Perusahaan -->
                                <div class="mb-4">
                                    <label for="alamat_perusahaan">Alamat Perusahaan</label>
                                    <textarea name="alamat_perusahaan" class="form-control @error('alamat_perusahaan') is-invalid @enderror"
                                        id="alamat_perusahaan" placeholder="Masukkan alamat lengkap perusahaan" required>{{ old('alamat_perusahaan') }}</textarea>
                                    @error('alamat_perusahaan')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- No HP Perusahaan -->
                                <div class="mb-4">
                                    <label for="nohp_perusahaan">No HP / WA Perusahaan</label>
                                    <input type="text" name="nohp_perusahaan"
                                        class="form-control @error('nohp_perusahaan') is-invalid @enderror"
                                        id="nohp_perusahaan" value="{{ old('nohp_perusahaan') }}"
                                        placeholder="Masukkan nomor telepon perusahaan" required>
                                    @error('nohp_perusahaan')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Ajukan Surat</button>
                            <a href="{{ route('surat.index') }}" class="btn btn-danger mt-2 ms-2">Batal</a>
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
            function toggleJudul() {
                if ($('#jenis_surat').val() === 'surat penelitian') {
                    $('#judul_penelitian_container').removeClass('d-none');
                } else {
                    $('#judul_penelitian_container').addClass('d-none');
                }
            }

            toggleJudul();
            $('#jenis_surat').change(function() {
                toggleJudul();
            });
        });
    </script>
@endpush
