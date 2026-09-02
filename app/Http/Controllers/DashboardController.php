<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Services\SystemMetricService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly SystemMetricService $metricService)
    {
    }

    public function index(): View
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($user->role === 'admin') {
            $artikels      = Artikel::orderBy('tanggal_publikasi', 'desc')->get();
            $systemMetrics = $this->metricService->getMetrics();

            return view('dashboard', compact('artikels', 'systemMetrics'));
        }

        $laporans        = $user->laporans()->orderBy('created_at', 'desc')->get();
        $totalLaporan    = $laporans->count();
        $laporanDiproses = $laporans->whereIn('status', ['Pending', 'Diproses', 'Menunggu'])->count();
        $laporanValid    = $laporans->where('status', 'Valid')->count();
        $totalPoin       = $user->poin ?? 0;

        return view('hunter-dashboard', compact('laporans', 'totalLaporan', 'laporanDiproses', 'laporanValid', 'totalPoin'));
    }

    public function systemMetrics(): JsonResponse
    {
        return response()->json($this->metricService->getMetrics());
    }
}
