<?php

namespace App\Http\Controllers\Superadmin;

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
        return view('superadmin.materials', $data);
    }
}
