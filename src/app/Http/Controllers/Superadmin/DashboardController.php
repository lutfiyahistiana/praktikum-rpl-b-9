<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Team;
use App\Models\Role;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $totalUsers = User::count();
        $totalTeams = Team::count();
        $onlineUsers = 0; // Placeholder for now
        $pendingUsers = 0; // Placeholder for now
        $roles = Role::withCount('users')->get();

        $data = array(
            'title'         => 'Dashboard',
            'menuDashboard' => 'active',
            'totalUsers'    => $totalUsers,
            'totalTeams'    => $totalTeams,
            'onlineUsers'   => $onlineUsers,
            'pendingUsers'  => $pendingUsers,
            'roles'         => $roles
        );
        return view('superadmin.dashboard', $data);
    }
}
