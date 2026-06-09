<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class ManageRoleController extends Controller
{
    public function showManageRole()
    {
        $users = User::all();

        $data = array(
            'title'          => 'Manage Role',
            'menuManageRole' => 'active',
            'users'          => $users
        );
        return view('superadmin.manageRole', $data);
    }
}
