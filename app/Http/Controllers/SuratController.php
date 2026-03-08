<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Surat;
use Illuminate\Http\Request;
use App\Http\Requests\SuratRequest;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SuratController extends Controller
{
    private function bulanRomawi($month)
    {
        $petaRomawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        return $petaRomawi[$month] ?? '';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Surat::query();

            $user = Auth::user();

            if ($user->is_admin) {
                // Admin dapat melihat semua data tanpa filter status
                $query = $query;
            } elseif ($user->is_wakil_dekan_I) {
                // Wakil Dekan I dapat melihat data dengan status "proses"
                $query->whereIn('status', ['proses']);
            } elseif ($user->is_dekan) {
                // Dekan hanya dapat melihat data dengan status "validasi"
                $query->where('status', 'validasi');
            } else {
                // Pengguna lain hanya dapat melihat data mereka sendiri dengan status "proses" atau "disetujui"
                $query->where('user_id', Auth::id())
                    ->whereIn('status', ['proses', 'validasi', 'disetujui']);
            }

            // Mengambil data
            $query = $query->with('user')->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('created_at', function ($item) {
                    return date('d-m-Y', strtotime($item->created_at));
                })
                ->addColumn('tgl_disetujui', function ($item) {
                    return $item->tgl_disetujui ? date('d-m-Y', strtotime($item->tgl_disetujui)) : '3 hari';
                })
                ->editColumn('no_unik', function ($item) {
                    return $item->user->npm ?? '';
                })
                ->editColumn('name', function ($item) {
                    return $item->user->name ?? '';
                })
                ->editColumn('kodepro', function ($item) {
                    $bulanRomawi = $this->bulanRomawi($item->created_at->month);
                    return $item->kodepro . '/KE/FST-UIS/YAPISTA/' . $bulanRomawi . '/' . \Carbon\Carbon::now()->format('Y');
                })
                ->editColumn('status', function ($item) {
                    $badgeColors = [
                        'proses' => 'bg-warning',
                        'disetujui' => 'bg-success',
                        'ditolak' => 'bg-danger',
                        'validasi' => 'bg-tertiary',
                    ];

                    $badge = '<span class="badge rounded-pill ' . $badgeColors[$item->status] . ' text-white px-3 py-2">' . $item->status . '</span>';

                    return $badge;
                })
                ->addColumn('action', function ($item) {

                    $buttons = '';

                    if ($item->status == 'disetujui' && Auth::user()->role == 'mahasiswa') {
                        $buttons .= '
                            <a href="' . route('surat.show', $item->id) . '" class="btn btn-sm btn-info text-white px-2" title="print">
                                <i class="fa-solid fa-print"></i>
                            </a>
                        ';
                    }

                    if (Auth::user()->role == 'admin' || Auth::user()->role == 'dekan' || Auth::user()->role == 'wakil dekan I') {

                        if ($item->status == 'disetujui') {
                            $buttons .= '
                                        <a href="' . route('surat.show', $item->id) . '" class="btn btn-sm btn-info text-white px-2" title="print">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                    ';
                        }

                        if ($item->status == 'proses' || $item->status == 'validasi') {
                            // Modal button for status change
                            $buttons .= '
                                    <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#bulkUpdateModal">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    
                                ';

                            $buttons .= '
                                    <form action="' . route('surat.destroy', $item->id) . '" method="POST" class="d-inline">
                                        ' . csrf_field() . '
                                        ' . method_field('delete') . '
                                        <button type="submit" class="btn btn-danger btn-sm" title="hapus">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                ';
                        }
                    }
                    return  $buttons;
                })
                ->rawColumns(['action', 'created_at', 'status', 'tgl_disetujui', 'kodepro', 'no_unik', 'name'])
                ->make();
        }
        $latestKP = null;
        $latestPenelitian = null;
        if (Auth::user()->is_mahasiswa) {
            $latestKP = Surat::where('user_id', Auth::id())
                ->where('jenis_surat', 'surat kp')
                ->latest()
                ->first();

            $latestPenelitian = Surat::where('user_id', Auth::id())
                ->where('jenis_surat', 'surat penelitian')
                ->latest()
                ->first();
        }

        return view('pages.surat.index', compact('latestKP', 'latestPenelitian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nomorUrutTerakhir = Surat::max('kodepro'); // Ubah nama atribut menjadi 'no_pendaftar'
        if ($nomorUrutTerakhir) {
            $prefix = '-';
            $lastNumber = substr($nomorUrutTerakhir, strlen($prefix)); // Mengambil nomor setelah tanda '-'
            $nomorUrut = $lastNumber ? (int)$lastNumber + 1 : 1; // Menambah nomor urut
        } else {
            $nomorUrut = 1; // Jika belum ada surat, mulai dengan nomor 1
        }

        $kodepro = $nomorUrut;

        $users = Auth::user();
        return view('pages.surat.create', compact('users', 'kodepro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SuratRequest $request)
    {
        // Ambil nomor terakhir berdasarkan tahun ini dan instansi yang sama
        $lastRecord = Surat::whereYear('created_at', now()->year)
            ->latest('id')
            ->first();

        // Ambil nomor urut
        // Jika tidak ada record tahun ini, nomor urut dimulai dari 1
        $nomorUrut = $lastRecord ? ((int)substr($lastRecord->kodepro, -3)) + 1 : 1;

        // Format nomor urut menjadi 3 digit
        $nomorUrutFormatted = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

        // Set kodepro baru, menggabungkan tahun dan nomor urut
        $kodepro = $nomorUrutFormatted;

        $user = Auth::user();
        $data = $request->validated();

        // Tambah tanggal estimasi 3 hari dari sekarang
        $data['tgl_estimasi'] = now()->addDays(3);

        // Ambil data dari user login dan form
        $data['user_id'] = Auth::id();
        $data['kodepro'] = $kodepro;  // Pastikan kodepro sudah terisi
        $data['jenis_surat'] = $request->jenis_surat;
        $data['judul_penelitian'] = $request->jenis_surat == 'surat penelitian'
            ? $request->judul_penelitian
            : "-";
        $data['tujuan'] = $request->tujuan;
        $data['nama_perusahaan'] = $request->nama_perusahaan;
        $data['alamat_perusahaan'] = $request->alamat_perusahaan;
        $data['nohp_perusahaan'] = $request->nohp_perusahaan;
        $data['status'] = "proses";
        $data['tgl_disetujui'] = null;

        Surat::create($data);

        Alert::success('success', 'Data added successfully')->autoclose(2000)->toToast();
        return redirect(route('surat.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Surat $surat)
    {
        return view('pages.surat.show', compact('surat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Surat $surat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ($id == 0) {
            // Handle bulk update
            $selectedIds = explode(',', $request->input('selected_ids')); // Get the selected IDs
            $status = $request->input('status'); // Get the new status

            // Validate the status
            if (!$status) {
                return redirect()->back()->withErrors(['error' => 'Please select a valid status.']);
            }

            // Update the selected Surat records
            Surat::whereIn('id', $selectedIds)->update([
                'status' => $status,
                'tgl_disetujui' => $status === 'disetujui' ? now() : null, // Update approval date if 'disetujui'
            ]);

            // Flash success message and redirect
            Alert::success('Success', 'Statuses updated successfully')->autoclose(2000)->toToast();
            return redirect()->route('surat.index');
        }

        $surat = Surat::findOrFail($id);

        $data = $request->all();
        if ($request->status == 'disetujui') {
            $data['tgl_disetujui'] = now();
        }
        $surat->update($data);

        Alert::success('Success', 'Data updated successfully')->autoclose(2000)->toToast();
        return redirect()->route('surat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Surat $surat)
    {
        $surat->delete();
        Alert::success('success', 'data deleted successfully')->autoclose(2000)->toToast();
        return redirect(route('surat.index'));
    }

    public function suratTervalidasi()
    {
        if (request()->ajax()) {
            // Mengambil hanya surat yang tervalidasi
            $query = Surat::where('status', 'validasi')->with('user');

            return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('created_at', function ($item) {
                    return date('d-m-Y', strtotime($item->created_at));
                })
                ->addColumn('tgl_disetujui', function ($item) {
                    return $item->tgl_disetujui ? date('d-m-Y', strtotime($item->tgl_disetujui)) : '-';
                })
                ->addColumn('action', function ($item) {
                    $buttons = '';
                    if (Auth::user()->role == 'admin' || Auth::user()->role == 'dekan') {
                        $buttons .= '
                            <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#bulkUpdateModal">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        ';
                    }
                    $buttons .= '
                        <a href="' . route('surat.show', $item->id) . '" class="btn btn-sm btn-info text-white" target="_blank" title="Print">
                            <i class="fa-solid fa-print"></i>
                        </a>
                    ';
                    return $buttons;
                })
                ->editColumn('no_unik', function ($item) {
                    return $item->user->npm ?? '';
                })
                ->editColumn('kodepro', function ($item) {
                    $bulanRomawi = $this->bulanRomawi($item->created_at->month);
                    return $item->kodepro . '/KE/FST-UIS/YAPISTA/' . $bulanRomawi . '/' . \Carbon\Carbon::now()->format('Y');
                })
                ->editColumn('name', function ($item) {
                    return $item->user->name ?? '';
                })
                ->rawColumns(['action', 'no_unik', 'name', 'kodepro'])
                ->make(true);
        }

        return view('pages.surat.surat_tervalidasi');
    }

    public function suratDisetujui()
    {
        if (request()->ajax()) {
            // Mengambil hanya surat yang disetujui
            $query = Surat::where('status', 'disetujui')->with('user');

            return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('created_at', function ($item) {
                    return date('d-m-Y', strtotime($item->created_at));
                })
                ->addColumn('tgl_disetujui', function ($item) {
                    return $item->tgl_disetujui ? date('d-m-Y', strtotime($item->tgl_disetujui)) : '-';
                })
                ->addColumn('action', function ($item) {
                    if (Auth::user()->is_admin || Auth::user()->is_dekan) {
                        return '<a href="' . route('surat.show', $item->id) . '" class="btn btn-sm btn-info text-white" target="_blank"><i class="fa-solid fa-print"></i></a>';
                    }
                })
                ->editColumn('no_unik', function ($item) {
                    return $item->user->npm ?? '';
                })
                ->editColumn('kodepro', function ($item) {
                    $bulanRomawi = $this->bulanRomawi($item->created_at->month);
                    return $item->kodepro . '/KE/FT-UIS/YAPISTA/' . $bulanRomawi . '/' . \Carbon\Carbon::now()->format('Y');
                })
                ->editColumn('name', function ($item) {
                    return $item->user->name ?? '';
                })
                ->rawColumns(['action', 'no_unik', 'name', 'kodepro'])
                ->make(true);
        }
        return view('pages.surat.surat_disetujui');
    }
}
