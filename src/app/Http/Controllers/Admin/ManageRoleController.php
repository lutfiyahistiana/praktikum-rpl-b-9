<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageRoleController extends Controller
{
    public function showManageRole()
    {
        $data = array(
            'title'         => 'Manage',
            'menuManage'    => 'active'
        );
        return view('admin.manageRole', $data);
    }
}
