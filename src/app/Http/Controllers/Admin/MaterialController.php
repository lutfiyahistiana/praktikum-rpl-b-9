<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function showMaterials()
    {
        $data = array(
            'title'         => 'Materials',
            'menuMaterials' => 'active'
        );
        return view('admin.materials', $data);
    }
}
