<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\DivisionMember;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function showMaterials()
    {
        $userId = Auth::id();

        // Cari divisi user
        $divisionMember = DivisionMember::where('anggota_id', $userId)->first();

        if ($divisionMember) {
            $materials = Material::with('files')
                ->where('division_id', $divisionMember->division_id)
                ->orderBy('created_at')
                ->get();
        } else {
            // Tidak ada divisi — tidak tampilkan materi
            $materials = collect();
        }

        return view('anggota.materials', [
            'title'         => 'Materials',
            'menuMaterials' => 'active',
            'materials'     => $materials,
        ]);
    }
}
