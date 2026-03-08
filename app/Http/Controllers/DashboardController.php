<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $latestKP = null;
        $latestPenelitian = null;
        $chartData = [];
        $totalKP = 0;
        $totalPenelitian = 0;
        $totalUser = 0;
        $latestApproved = collect();
        $statusCounts = [
            'proses' => 0,
            'validasi' => 0,
            'disetujui' => 0,
            'ditolak' => 0,
        ];

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

        if (Auth::user()->is_admin || Auth::user()->is_dekan || Auth::user()->is_wakil_dekan_I) {
            $currentYear = (int)date('Y');
            $endYear = max(2030, $currentYear);
            $startYear = max(2026, $endYear - 4);
            $years = range($startYear, $startYear + 4);

            $kpData = [];
            $penelitianData = [];

            foreach ($years as $year) {
                $kpData[] = Surat::where('jenis_surat', 'surat kp')
                    ->whereYear('created_at', $year)
                    ->count();

                $penelitianData[] = Surat::where('jenis_surat', 'surat penelitian')
                    ->whereYear('created_at', $year)
                    ->count();
            }

            $chartData = [
                'labels' => $years,
                'kp' => $kpData,
                'penelitian' => $penelitianData
            ];

            $totalKP = Surat::where('jenis_surat', 'surat kp')->count();
            $totalPenelitian = Surat::where('jenis_surat', 'surat penelitian')->count();
            $totalUser = User::count();

            $latestApproved = Surat::with('user')
                ->where('status', 'disetujui')
                ->latest()
                ->take(5)
                ->get();

            $statusCounts = [
                'proses' => Surat::where('status', 'proses')->count(),
                'validasi' => Surat::where('status', 'validasi')->count(),
                'disetujui' => Surat::where('status', 'disetujui')->count(),
                'ditolak' => Surat::where('status', 'ditolak')->count(),
            ];
        }

        return view('pages.dashboard.index', compact('latestKP', 'latestPenelitian', 'chartData', 'totalKP', 'totalPenelitian', 'totalUser', 'latestApproved', 'statusCounts'));
    }
}
