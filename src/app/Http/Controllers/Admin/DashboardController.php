<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.dashboard', $data);
    }
}
