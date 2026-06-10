<?php

namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Material;
use App\Models\MaterialFile;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $totalBab = Material::count();
        $totalFile = MaterialFile::count();

        $data = array(
            'title'         => 'Dashboard',
            'menuDashboard' => 'active',
            'totalBab'      => $totalBab,
            'totalFile'     => $totalFile
        );
        return view('pelatih.dashboard', $data);
    }
}
