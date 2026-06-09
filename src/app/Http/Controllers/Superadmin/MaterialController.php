<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Material;

class MaterialController extends Controller
{
    public function showMaterials()
    {
        $materials = Material::with(['uploader', 'files'])->get();

        $data = array(
            'title'         => 'Materials',
            'menuMaterials' => 'active',
            'materials'     => $materials
        );
        return view('superadmin.materials', $data);
    }
}
