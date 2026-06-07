<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function showMaterials()
    {
        $data = array(
            'title'         => 'Materials',
            'menuMaterials' => 'active'
        );
        return view('materials.anggota', $data);
    }
}
