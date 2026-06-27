<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function showMaterials(Request $request)
    {
        $divisions = \App\Models\Division::withCount('materials')->get();

        $selectedDivision = null;
        $materials = [];

        if ($request->has('division_id')) {
            $selectedDivision = \App\Models\Division::find($request->division_id);

            if ($selectedDivision) {
                $materialsData = Material::with(['files', 'uploader'])
                    ->where('division_id', $selectedDivision->id_division)
                    ->get();

                foreach ($materialsData as $material) {
                    $files = [];
                    foreach ($material->files as $file) {
                        $extension = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));
                        $icon = 'file'; $color = '#EF4444'; $background = '#FEE2E2';

                        if (in_array($extension, ['mp4', 'avi', 'mkv', 'mov'])) {
                            $icon = 'play'; $color = '#008CFF'; $background = '#DBEAFE';
                        } elseif (in_array($extension, ['ppt', 'pptx'])) {
                            $color = '#F97316'; $background = '#FFEDD5';
                        } elseif (in_array($extension, ['doc', 'docx'])) {
                            $color = '#2563EB'; $background = '#DBEAFE';
                        }

                        $files[] = [
                            'id'         => $file->id_material_file,
                            'name'       => $file->file_name,
                            'size'       => strtoupper($extension) ?: 'File',
                            'color'      => $color,
                            'background' => $background,
                            'icon'       => $icon,
                            'path'       => $file->file_path,
                        ];
                    }

                    $materials[] = [
                        'title'       => $material->title,
                        'description' => $material->description ?? 'Tidak ada deskripsi.',
                        'uploader'    => $material->uploader ? $material->uploader->name : 'Unknown',
                        'files'       => $files,
                    ];
                }
            }
        }

        return view('superadmin.materials', [
            'title'            => 'Materials',
            'menuMaterials'    => 'active',
            'divisions'        => $divisions,
            'selectedDivision' => $selectedDivision,
            'materials'        => $materials,
        ]);
    }
}
