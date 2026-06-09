<?php

namespace App\Http\Controllers\KetuaTim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function showMaterials()
    {
        $materialsData = \App\Models\Material::with('files')->get();
        $materials = [];

        foreach ($materialsData as $material) {
            $files = [];
            foreach ($material->files as $file) {
                $extension = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));
                $icon = 'file';
                $color = '#EF4444';
                $background = '#FEE2E2';

                if (in_array($extension, ['mp4', 'avi', 'mkv', 'mov'])) {
                    $icon = 'play';
                    $color = '#008CFF';
                    $background = '#DBEAFE';
                } elseif (in_array($extension, ['ppt', 'pptx'])) {
                    $color = '#F97316';
                    $background = '#FFEDD5';
                } elseif (in_array($extension, ['doc', 'docx'])) {
                    $color = '#2563EB';
                    $background = '#DBEAFE';
                }

                $size = 'Tidak diketahui';
                if ($file->file_path && file_exists(public_path($file->file_path))) {
                    $bytes = filesize(public_path($file->file_path));
                    $size = number_format($bytes / 1048576, 2) . ' MB';
                }

                $files[] = [
                    'name' => $file->file_name,
                    'size' => $size,
                    'color' => $color,
                    'background' => $background,
                    'icon' => $icon,
                ];
            }

            $materials[] = [
                'title' => $material->title,
                'description' => $material->description ?? 'Tidak ada deskripsi.',
                'files' => $files,
            ];
        }

        $data = array(
            'title'         => 'Materials',
            'menuMaterials' => 'active',
            'materials'     => $materials,
        );
        return view('ketuaTim.materials', $data);
    }
}
