<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $data = array(
            'title'         => 'Dashboard',
            'menuDashboard' => 'active'
        );
        return view('anggota.dashboard', $data);
    }
}
