<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Material;

class MaterialController extends Controller
{
    public function showMaterials()
    {
        $materials = Material::with('files')
            ->orderBy('created_at')
            ->get();

        $data = [
            'title'         => 'Materials',
            'menuMaterials' => 'active',
            'materials'     => $materials,
        ];

        return view('anggota.materials', $data);
    }
}