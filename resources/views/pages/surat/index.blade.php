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
                <li class="breadcrumb-item active" aria-current="page">Pengajuan Surat</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Data Pengajuan Surat</h1>
                <p class="mb-0">Manajemen data pengajuan surat sistem Office FST Universitas Ibnu Sina Batam.</p>
                @if (Auth::user()->is_mahasiswa)
                    <div class="card bg-outline-success border-0 shadow-sm mt-3">
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
                                    <p class="mt-2 mb-0 text-tertiary"><i
                                            class="fa-solid fa-info-circle me-1 text-info"></i>
                                        Silakan mengajukan surat.</p>
                                @endif

                                @if ($latestKP)
                                    <div class="mb-3">
                                        <p class="mb-1 text-gray-700">Status Pengajuan: <strong>Surat Kerja Praktek
                                                (KP)</strong></p>
                                        @if ($latestKP->status == 'proses')
                                            <p class="mb-0 text-secondary"><i
                                                    class="fa-solid fa-clock me-1 text-warning"></i>
                                                Estimasi: <strong>3 hari kerja</strong> (Tahap: Menunggu Validasi Wakil
                                                Dekan I).
                                            </p>
                                        @elseif($latestKP->status == 'validasi')
                                            <p class="mb-0 text-secondary"><i
                                                    class="fa-solid fa-clock me-1 text-tertiary"></i>
                                                Estimasi: <strong>1-2 hari kerja</strong> (Tahap: Menunggu Persetujuan
                                                Dekan).</p>
                                        @elseif($latestKP->status == 'disetujui')
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0 text-success"><i
                                                        class="fa-solid fa-check-circle me-1 text-success"></i> Pengajuan
                                                    Selesai! Surat Anda sudah dapat dicetak.</p>
                                                <a href="{{ route('surat.show', $latestKP->id) }}"
                                                    class="btn btn-sm btn-info text-white" target="_blank">
                                                    <i class="fa-solid fa-print me-1"></i> Cetak Surat
                                                </a>
                                            </div>
                                        @elseif($latestKP->status == 'ditolak')
                                            <p class="mb-0 text-secondary"><i
                                                    class="fa-solid fa-times-circle me-1 text-danger"></i> Pengajuan
                                                Ditolak.
                                                Silakan hubungi admin atau ajukan kembali.</p>
                                        @endif
                                    </div>
                                    @if ($latestPenelitian)
                                        <hr>
                                    @endif
                                @endif

                                @if ($latestPenelitian)
                                    <div>
                                        <p class="mb-1 text-gray-700">Status Pengajuan: <strong>Surat Izin
                                                Penelitian</strong></p>
                                        @if ($latestPenelitian->status == 'proses')
                                            <p class="mb-0 text-secondary"><i
                                                    class="fa-solid fa-clock me-1 text-warning"></i>
                                                Estimasi: <strong>3 hari kerja</strong> (Tahap: Menunggu Validasi Wakil
                                                Dekan I).
                                            </p>
                                        @elseif($latestPenelitian->status == 'validasi')
                                            <p class="mb-0 text-secondary"><i
                                                    class="fa-solid fa-clock me-1 text-tertiary"></i>
                                                Estimasi: <strong>1-2 hari kerja</strong> (Tahap: Menunggu Persetujuan
                                                Dekan).</p>
                                        @elseif($latestPenelitian->status == 'disetujui')
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0 text-success"><i
                                                        class="fa-solid fa-check-circle me-1 text-success"></i> Pengajuan
                                                    Selesai! Surat Anda sudah dapat dicetak.</p>
                                                <a href="{{ route('surat.show', $latestPenelitian->id) }}"
                                                    class="btn btn-sm btn-info text-white" target="_blank">
                                                    <i class="fa-solid fa-print me-1"></i> Cetak Surat
                                                </a>
                                            </div>
                                        @elseif($latestPenelitian->status == 'ditolak')
                                            <p class="mb-0 text-secondary"><i
                                                    class="fa-solid fa-times-circle me-1 text-danger"></i> Pengajuan
                                                Ditolak.
                                                Silakan hubungi admin atau ajukan kembali.</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div>
                <a href="{{ route('surat.create') }}" class="btn btn-primary d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Pengajuan
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table display nowrap rounded table-centered" id="crudTable" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>NO</th>
                            <th style="text-align: left">No Surat</th>
                            <th style="text-align: left">Jenis Surat</th>

                            @if (Auth::user()->is_admin || Auth::user()->is_dekan || Auth::user()->is_wakil_dekan_I)
                                <th style="text-align: left">NPM</th>
                                <th style="text-align: left">Nama Mahasiswa</th>
                                <th style="text-align: left">Judul Penelitian</th>
                            @endif

                            <th style="text-align: left">Tujuan Departemen</th>
                            <th style="text-align: left">Nama Perusahaan</th>
                            <th style="text-align: left">Alamat Perusahaan</th>
                            <th style="text-align: left">No HP/WA Perusahaan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Disetujui</th>
                            <th>Status</th>
                            @if (Auth::user()->is_admin || Auth::user()->is_dekan || Auth::user()->is_mahasiswa || Auth::user()->is_wakil_dekan_I)
                                <th style="text-align: center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Bulk Update / Update Status -->
    <div class="modal fade" id="bulkUpdateModal" tabindex="-1" role="dialog" aria-labelledby="bulkUpdateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="{{ route('surat.update', 0) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="h6 modal-title">Update Status Surat</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="selected_ids" id="selected_ids">
                        <div class="mb-3">
                            <label for="status">Pilih Status Baru</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="" selected disabled>Pilih Status</option>
                                @if (Auth::user()->role == 'wakil dekan I')
                                    <option value="validasi">Validasi</option>
                                @endif
                                @if (Auth::user()->role == 'dekan' || Auth::user()->role == 'admin' || Auth::user()->role == 'super admin')
                                    <option value="disetujui">Disetujui</option>
                                @endif
                                <option value="ditolak">Ditolak (Hapus)</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-link text-gray-600 ms-auto"
                            data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var dataTable = $('#crudTable').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('surat.index') }}',
                },
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return '<input type="checkbox" class="row-select" value="' + full.id +
                                '">';
                        }
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '5%',
                        class: 'text-center'
                    },
                    {
                        data: 'kodepro',
                        name: 'kodepro',
                        width: '30',
                        class: 'text-left'
                    },
                    {
                        data: 'jenis_surat',
                        name: 'jenis_surat',
                        width: '20',
                        class: 'text-left'
                    },
                    @if (Auth::user()->is_admin || Auth::user()->is_dekan || Auth::user()->is_wakil_dekan_I)
                        {
                            data: 'no_unik',
                            name: 'no_unik',
                            width: '20',
                            class: 'text-left'
                        }, {
                            data: 'name',
                            name: 'name',
                            width: '20',
                            class: 'text-left'
                        }, {
                            data: 'judul_penelitian',
                            name: 'judul_penelitian',
                            width: '20',
                            class: 'text-left'
                        },
                    @endif {
                        data: 'tujuan',
                        name: 'tujuan',
                        width: '20',
                        class: 'text-left'
                    },
                    {
                        data: 'nama_perusahaan',
                        name: 'nama_perusahaan',
                        width: '20',
                        class: 'text-left'
                    },
                    {
                        data: 'alamat_perusahaan',
                        name: 'alamat_perusahaan',
                        width: '20',
                        class: 'text-left'
                    },
                    {
                        data: 'nohp_perusahaan',
                        name: 'nohp_perusahaan',
                        width: '20',
                        class: 'text-left'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        width: '20%'
                    },
                    {
                        data: 'tgl_disetujui',
                        name: 'tgl_disetujui',
                        width: '20%'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        width: 'auto',
                        class: 'text-left'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '15%'
                    }
                ]
            });

            // Toggle manual selection and update selected_ids for bulk modal
            $('#select-all').on('click', function() {
                var rows = dataTable.rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
                updateSelectedIds();
            });

            $('#crudTable tbody').on('change', 'input[type="checkbox"]', function() {
                if (!this.checked) {
                    var el = $('#select-all').get(0);
                    if (el && el.checked && ('indeterminate' in el)) {
                        el.indeterminate = true;
                    }
                }
                updateSelectedIds();
            });

            function updateSelectedIds() {
                var selectedIds = [];
                $('.row-select:checked').each(function() {
                    selectedIds.push($(this).val());
                });
                $('#selected_ids').val(selectedIds.join(','));
            }

            // When the bulk update modal is shown, make sure we have selected IDs or populate if single click
            $('#bulkUpdateModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.closest('tr').find('.row-select').val();

                // If the button clicked was inside a row, and nothing is checked, just use that row's ID
                if (id && $('#selected_ids').val() === "") {
                    $('#selected_ids').val(id);
                }
            });
        });
    </script>
@endpush
