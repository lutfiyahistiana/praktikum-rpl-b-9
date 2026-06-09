<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $userId = Auth::id();

        $allTasks = Task::where('assigned_to', $userId)->get();

        $totalTugas     = $allTasks->count();
        $totalSelesai   = $allTasks->where('status', 'selesai')->count();
        $totalBerjalan  = $allTasks->where('status', 'belum_dikerjakan')
                                   ->filter(fn($t) => !$t->deadline || !Carbon::parse($t->deadline)->isPast())
                                   ->count();
        $totalTerlambat = $allTasks->where('status', 'belum_dikerjakan')
                                   ->filter(fn($t) => $t->deadline && Carbon::parse($t->deadline)->isPast())
                                   ->count();

        // Progress = persentase task selesai dari total task
        $avgProgress = $totalTugas > 0 ? round(($totalSelesai / $totalTugas) * 100) : 0;

        $tugasBelumSelesai = $allTasks->where('status', 'belum_dikerjakan')
                                      ->sortBy('deadline')
                                      ->values();

        return view('anggota.dashboard', [
            'title'             => 'Dashboard',
            'menuDashboard'     => 'active',
            'totalTugas'        => $totalTugas,
            'totalSelesai'      => $totalSelesai,
            'totalBerjalan'     => $totalBerjalan,
            'totalTerlambat'    => $totalTerlambat,
            'avgProgress'       => $avgProgress,
            'tugasBelumSelesai' => $tugasBelumSelesai,
        ]);
    }
}