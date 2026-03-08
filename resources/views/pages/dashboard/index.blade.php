@extends('pages.dashboard.template')

@section('content')
    <!-- content -->
    <div class="py-4">
        @if (Auth::user()->is_mahasiswa)
            <div class="card bg-outline-success border-0 shadow-sm mb-4">
                <div class="card-body p-3 text-tertiary">
                    <div class="small">
                        <div class="d-flex flex-wrap gap-2 mb-2 align-items-center">
                            <span><span class="badge bg-warning text-white me-1">proses</span>: Menunggu validasi WD
                                I</span>
                            <span class="text-gray-400">|</span>
                            <span><span class="badge bg-tertiary text-white me-1">validasi</span>: Menunggu
                                persetujuan Dekan</span>
                            <span class="text-gray-400">|</span>
                            <span><span class="badge bg-success text-white me-1">disetujui</span>: Surat bisa
                                dicetak</span>
                            <span class="text-gray-400">|</span>
                            <span><span class="badge bg-danger text-white me-1">ditolak</span>: Pengajuan
                                ditolak</span>
                        </div>
                        <hr>
                        @if (!$latestKP && !$latestPenelitian)
                            <p class="mt-2 mb-0 text-tertiary"><i class="fa-solid fa-info-circle me-1 text-info"></i>
                                Silakan mengajukan surat.</p>
                        @endif

                        @if ($latestKP)
                            <div class="mb-3">
                                <p class="mb-1 text-gray-700">Status Pengajuan: <strong>Surat Kerja Praktek (KP)</strong>
                                </p>
                                @if ($latestKP->status == 'proses')
                                    <p class="mb-0 text-secondary"><i class="fa-solid fa-clock me-1 text-warning"></i>
                                        Estimasi: <strong>3 hari kerja</strong> (Tahap: Menunggu Validasi Wakil Dekan I).
                                    </p>
                                @elseif($latestKP->status == 'validasi')
                                    <p class="mb-0 text-secondary"><i class="fa-solid fa-clock me-1 text-tertiary"></i>
                                        Estimasi: <strong>1-2 hari kerja</strong> (Tahap: Menunggu Persetujuan Dekan).</p>
                                @elseif($latestKP->status == 'disetujui')
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-0 text-success"><i
                                                class="fa-solid fa-check-circle me-1 text-success"></i>
                                            Pengajuan Selesai! Surat Anda sudah dapat dicetak.</p>
                                        <a href="{{ route('surat.show', $latestKP->id) }}"
                                            class="btn btn-sm btn-info text-white" target="_blank">
                                            <i class="fa-solid fa-print me-1"></i> Cetak Surat
                                        </a>
                                    </div>
                                @elseif($latestKP->status == 'ditolak')
                                    <p class="mb-0 text-secondary"><i class="fa-solid fa-times-circle me-1 text-danger"></i>
                                        Pengajuan Ditolak. Silakan hubungi admin atau ajukan kembali.</p>
                                @endif
                            </div>
                            @if ($latestPenelitian)
                                <hr>
                            @endif
                        @endif

                        @if ($latestPenelitian)
                            <div>
                                <p class="mb-1 text-gray-700">Status Pengajuan: <strong>Surat Izin Penelitian</strong></p>
                                @if ($latestPenelitian->status == 'proses')
                                    <p class="mb-0 text-secondary"><i class="fa-solid fa-clock me-1 text-warning"></i>
                                        Estimasi: <strong>3 hari kerja</strong> (Tahap: Menunggu Validasi Wakil Dekan I).
                                    </p>
                                @elseif($latestPenelitian->status == 'validasi')
                                    <p class="mb-0 text-secondary"><i class="fa-solid fa-clock me-1 text-tertiary"></i>
                                        Estimasi: <strong>1-2 hari kerja</strong> (Tahap: Menunggu Persetujuan Dekan).</p>
                                @elseif($latestPenelitian->status == 'disetujui')
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-0 text-success"><i
                                                class="fa-solid fa-check-circle me-1 text-success"></i>
                                            Pengajuan Selesai! Surat Anda sudah dapat dicetak.</p>
                                        <a href="{{ route('surat.show', $latestPenelitian->id) }}"
                                            class="btn btn-sm btn-info text-white" target="_blank">
                                            <i class="fa-solid fa-print me-1"></i> Cetak Surat
                                        </a>
                                    </div>
                                @elseif($latestPenelitian->status == 'ditolak')
                                    <p class="mb-0 text-secondary"><i class="fa-solid fa-times-circle me-1 text-danger"></i>
                                        Pengajuan Ditolak. Silakan hubungi admin atau ajukan kembali.</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Card Surat KP -->
                <div class="col-12 col-sm-6 col-xl-6 mb-4">
                    <a href="{{ route('surat.create', ['type' => 'kp']) }}" class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div
                                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-400 mb-0">Pengajuan Surat</h2>
                                        <h3 class="fw-extrabold mb-1">Kerja Praktek (KP)</h3>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-400 mb-0">Surat KP</h2>
                                    </div>
                                    <small class="text-gray-500">
                                        Klik untuk mengajukan surat KP
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Card Surat Penelitian -->
                <div class="col-12 col-sm-6 col-xl-6 mb-4">
                    <a href="{{ route('surat.create', ['type' => 'penelitian']) }}" class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div
                                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-400 mb-0">Pengajuan Surat</h2>
                                        <h3 class="fw-extrabold mb-1">Izin Penelitian</h3>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-400 mb-0">Surat Penelitian</h2>
                                    </div>
                                    <small class="text-gray-500">
                                        Klik untuk mengajukan izin penelitian
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif

        @if (Auth::user()->is_admin || Auth::user()->is_dekan || Auth::user()->is_wakil_dekan_I)
            <!-- Row 1: Summary Cards -->
            <div class="row">
                <!-- Summary Card 1: Surat KP -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-shape-primary rounded me-4">
                                    <i class="fa-solid fa-file-contract"></i>
                                </div>
                                <div>
                                    <h2 class="h6 text-gray-400 mb-0">Surat KP</h2>
                                    <h3 class="fw-extrabold mb-0">{{ $totalKP }}</h3>
                                    <small class="text-gray-500">Total Pengajuan KP</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Summary Card 2: Surat Penelitian -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-shape-info rounded me-4">
                                    <i class="fa-solid fa-file-medical"></i>
                                </div>
                                <div>
                                    <h2 class="h6 text-gray-400 mb-0">Surat Izin Penelitian</h2>
                                    <h3 class="fw-extrabold mb-0">{{ $totalPenelitian }}</h3>
                                    <small class="text-gray-500">Total Pengajuan Penelitian</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Summary Card 3: Total Pengguna -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-shape icon-shape-secondary rounded me-4">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div>
                                    <h2 class="h6 text-gray-400 mb-0">Total Pengguna</h2>
                                    <h3 class="fw-extrabold mb-0">{{ $totalUser }}</h3>
                                    <small class="text-gray-500">Jumlah User Terdaftar</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Chart & Status Distribution -->
            <div class="row">
                <div class="col-12 col-xl-8 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col">
                                    <h2 class="h5 mb-1 text-gray-700">Statistik Pengajuan Surat</h2>
                                    <div class="d-flex align-items-baseline mb-2">
                                        <h3 class="fw-extrabold mb-0 me-2">{{ $totalKP + $totalPenelitian }}</h3>
                                        <span class="text-gray-400 small fw-bold">Total Pengajuan</span>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="d-flex align-items-center">
                                            <span class="dot bg-primary me-2"></span>
                                            <span class="text-gray-500 small fw-bold">KP: <span
                                                    class="text-dark">{{ $totalKP }}</span></span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="dot bg-info me-2"></span>
                                            <span class="text-gray-500 small fw-bold">Penelitian: <span
                                                    class="text-dark">{{ $totalPenelitian }}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div style="height: 300px;">
                                <canvas id="letterStatsChartModern"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-header d-flex flex-row align-items-center flex-0 border-bottom">
                            <div class="d-block">
                                <div class="h6 fw-normal text-gray mb-1">Status Permohonan</div>
                                <h2 class="h3 fw-extrabold">
                                    {{ $statusCounts['proses'] + $statusCounts['validasi'] + $statusCounts['disetujui'] + $statusCounts['ditolak'] }}
                                </h2>
                                <small class="text-gray-500">Distribusi status surat masuk</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-bold small text-gray-700">Proses (WD I)</span>
                                    <span class="fw-bold small">{{ $statusCounts['proses'] }}</span>
                                </div>
                                <div class="progress progress-sm mb-0">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $statusCounts['proses'] > 0 ? ($statusCounts['proses'] / ($statusCounts['proses'] + $statusCounts['validasi'] + $statusCounts['disetujui'] + $statusCounts['ditolak'])) * 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-bold small text-gray-700">Validasi (Dekan)</span>
                                    <span class="fw-bold small">{{ $statusCounts['validasi'] }}</span>
                                </div>
                                <div class="progress progress-sm mb-0">
                                    <div class="progress-bar bg-tertiary" role="progressbar"
                                        style="width: {{ $statusCounts['validasi'] > 0 ? ($statusCounts['validasi'] / ($statusCounts['proses'] + $statusCounts['validasi'] + $statusCounts['disetujui'] + $statusCounts['ditolak'])) * 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-bold small text-gray-700">Disetujui</span>
                                    <span class="fw-bold small text-success">{{ $statusCounts['disetujui'] }}</span>
                                </div>
                                <div class="progress progress-sm mb-0">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $statusCounts['disetujui'] > 0 ? ($statusCounts['disetujui'] / ($statusCounts['proses'] + $statusCounts['validasi'] + $statusCounts['disetujui'] + $statusCounts['ditolak'])) * 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-bold small text-gray-700">Ditolak</span>
                                    <span class="fw-bold small text-danger">{{ $statusCounts['ditolak'] }}</span>
                                </div>
                                <div class="progress progress-sm mb-0">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ $statusCounts['ditolak'] > 0 ? ($statusCounts['ditolak'] / ($statusCounts['proses'] + $statusCounts['validasi'] + $statusCounts['disetujui'] + $statusCounts['ditolak'])) * 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 3: Recap Table & Latest Approved -->
            <div class="row">
                <div class="col-12 col-xl-8 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-header border-0 pb-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h2 class="fs-5 fw-bold mb-0">Rekapitulasi Pengajuan Surat</h2>
                                    <small class="text-gray-500">Ringkasan pengajuan surat 5 tahun terakhir (mulai
                                        2026)</small>
                                </div>
                                <div class="col text-end">
                                    <a href="{{ route('surat.index') }}" class="btn btn-sm btn-primary">Lihat Semua
                                        Surat</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-bottom" scope="col">Tahun</th>
                                        <th class="border-bottom" scope="col">Surat KP</th>
                                        <th class="border-bottom" scope="col">Surat Penelitian</th>
                                        <th class="border-bottom" scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($chartData['labels']) && count($chartData['labels']) > 0)
                                        @foreach ($chartData['labels'] as $index => $year)
                                            <tr>
                                                <th class="text-gray-900" scope="row">{{ $year }}</th>
                                                <td class="fw-bolder text-gray-500">{{ $chartData['kp'][$index] ?? 0 }}
                                                </td>
                                                <td class="fw-bolder text-gray-500">
                                                    {{ $chartData['penelitian'][$index] ?? 0 }}</td>
                                                <td class="fw-bolder text-gray-500">
                                                    <span class="badge bg-tertiary">
                                                        {{ ($chartData['kp'][$index] ?? 0) + ($chartData['penelitian'][$index] ?? 0) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center py-4"><span class="text-gray-500">Belum
                                                    ada data pengajuan.</span></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                            <h2 class="fs-5 fw-bold mb-0">Pengajuan Disetujui Terkini</h2>
                            <a href="{{ route('surat.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush list my--3">
                                @forelse($latestApproved as $surat)
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div
                                                    class="icon-shape icon-xs {{ $surat->jenis_surat == 'surat kp' ? 'bg-primary' : 'bg-info' }} rounded text-white d-flex align-items-center justify-content-center">
                                                    <i
                                                        class="fa-solid {{ $surat->jenis_surat == 'surat kp' ? 'fa-file-contract' : 'fa-file-medical' }}"></i>
                                                </div>
                                            </div>
                                            <div class="col-auto ms--2">
                                                <h4 class="h6 mb-0">
                                                    <a href="#">{{ $surat->user->name }}</a>
                                                </h4>
                                                <div class="d-flex align-items-center">
                                                    <small
                                                        class="text-uppercase fw-bold text-gray-500">{{ $surat->jenis_surat }}</small>
                                                </div>
                                            </div>
                                            <div class="col text-end">
                                                <span class="badge bg-success">Disetujui</span>
                                                <div class="small text-gray-400 mt-1">
                                                    {{ $surat->updated_at->format('d M Y') }}</div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item px-0">
                                        <div class="text-center py-4 text-gray-500">Belum ada pengajuan disetujui.</div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .dot {
                    height: 10px;
                    width: 10px;
                    border-radius: 50%;
                    display: inline-block;
                }

                .bg-primary {
                    background-color: #262B40 !important;
                }

                .bg-info {
                    background-color: #10B981 !important;
                }

                .progress-sm {
                    height: 8px;
                    border-radius: 4px;
                }
            </style>
        @endif
    </div>

    <div class="theme-settings card bg-gray-800 pt-2 collapse" id="theme-settings">
        <div class="card-body bg-gray-800 text-white pt-4">
            <button type="button" class="btn-close theme-settings-close" aria-label="Close" data-bs-toggle="collapse"
                href="#theme-settings" role="button" aria-expanded="false" aria-controls="theme-settings"></button>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="m-0 mb-1 me-4 fs-7">Open source <span role="img" aria-label="gratitude">💛</span>
                </p>
                <a class="github-button" href="https://github.com/themesberg/volt-bootstrap-5-dashboard"
                    data-color-scheme="no-preference: dark; light: light; dark: light;" data-icon="octicon-star"
                    data-size="large" data-show-count="true"
                    aria-label="Star themesberg/volt-bootstrap-5-dashboard on GitHub">Star</a>
            </div>
            <a href="https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard" target="_blank"
                class="btn btn-secondary d-inline-flex align-items-center justify-content-center mb-3 w-100">
                Download
                <svg class="icon icon-xs ms-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
            <p class="fs-7 text-gray-300 text-center">Available in the following technologies:</p>
            <div class="d-flex justify-content-center">
                <a class="me-3" href="https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard"
                    target="_blank">
                    <img src="../../assets/img/technologies/bootstrap-5-logo.svg" class="image image-xs">
                </a>
                <a href="https://demo.themesberg.com/volt-react-dashboard/#/" target="_blank">
                    <img src="../../assets/img/technologies/react-logo.svg" class="image image-xs">
                </a>
            </div>
        </div>
    </div>

    <div class="card theme-settings bg-gray-800 theme-settings-expand" id="theme-settings-expand">
        <div class="card-body bg-gray-800 text-white rounded-top p-3 py-2">
            <span class="fw-bold d-inline-flex align-items-center h6">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd"></path>
                </svg>
                Settings
            </span>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    @if (Auth::user()->is_admin || Auth::user()->is_dekan || Auth::user()->is_wakil_dekan_I)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('letterStatsChartModern');
                if (ctx) {
                    // Global Defaults
                    Chart.defaults.font.family = "'Inter', sans-serif";
                    Chart.defaults.color = '#9CA3AF';

                    const gradientKP = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
                    gradientKP.addColorStop(0, 'rgba(38, 43, 64, 0.2)');
                    gradientKP.addColorStop(1, 'rgba(38, 43, 64, 0)');

                    const gradientPenelitian = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
                    gradientPenelitian.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
                    gradientPenelitian.addColorStop(1, 'rgba(16, 185, 129, 0)');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($chartData['labels'] ?? []) !!},
                            datasets: [{
                                    label: 'Surat KP',
                                    data: {!! json_encode($chartData['kp'] ?? []) !!},
                                    backgroundColor: '#262B40',
                                    borderColor: '#262B40',
                                    borderWidth: 1,
                                    borderRadius: 6,
                                    barPercentage: 0.6,
                                    categoryPercentage: 0.5
                                },
                                {
                                    label: 'Surat Izin Penelitian',
                                    data: {!! json_encode($chartData['penelitian'] ?? []) !!},
                                    backgroundColor: '#10B981',
                                    borderColor: '#10B981',
                                    borderWidth: 1,
                                    borderRadius: 6,
                                    barPercentage: 0.6,
                                    categoryPercentage: 0.5
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            interaction: {
                                intersect: false,
                                mode: 'index',
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    padding: 15,
                                    backgroundColor: 'rgba(38, 43, 64, 1)',
                                    titleFont: {
                                        size: 14,
                                        weight: '700'
                                    },
                                    bodyFont: {
                                        size: 14
                                    },
                                    cornerRadius: 10,
                                    displayColors: true,
                                    boxPadding: 5
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        color: '#6B7280',
                                        font: {
                                            weight: '600',
                                            size: 12
                                        }
                                    }
                                },
                                y: {
                                    grid: {
                                        borderDash: [5, 5],
                                        color: 'rgba(156, 163, 175, 0.15)',
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#6B7280',
                                        font: {
                                            weight: '600',
                                            size: 12
                                        },
                                        beginAtZero: true,
                                        stepSize: 1,
                                        precision: 0,
                                        padding: 10
                                    }
                                }
                            }
                        }
                    });
                }
            });
        </script>
    @endif
@endpush
