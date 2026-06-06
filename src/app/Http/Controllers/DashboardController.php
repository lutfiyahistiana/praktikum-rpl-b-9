<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $data = array(
            'title'         => 'Dashboard',
            'menuDashboard' => 'active'
        );
        return view('dashboard.dashboard', $data);
    }
}
