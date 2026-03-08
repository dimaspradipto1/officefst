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
                <li class="breadcrumb-item active" aria-current="page">Data Surat Disetujui</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4 text-uppercase">Data Surat Disetujui</h1>
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
                            @if (Auth::user()->is_admin || Auth::user()->is_dekan || Auth::user()->is_mahasiswa)
                                <th style="text-align: center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
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
                    url: '{{ route('surat-disetujui') }}',
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
                        class: 'text-left',
                        render: function(data, type, row) {
                            return '<span class="badge bg-success text-white px-3 py-2">disetujui</span>';
                        }
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

            $('#select-all').on('click', function() {
                var rows = dataTable.rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            $('#crudTable tbody').on('change', 'input[type="checkbox"]', function() {
                if (!this.checked) {
                    var el = $('#select-all').get(0);
                    if (el && el.checked && ('indeterminate' in el)) {
                        el.indeterminate = true;
                    }
                }
            });
        });
    </script>
@endpush
