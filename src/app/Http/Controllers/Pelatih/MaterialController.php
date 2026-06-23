<?php

namespace App\Http\Controllers\Pelatih;

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
                $materialsData = Material::with('files')
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
                        'id'          => $material->id_material,
                        'title'       => $material->title,
                        'description' => $material->description ?? 'Tidak ada deskripsi.',
                        'files'       => $files,
                    ];
                }
            }
        }

        $data = array(
            'title'            => 'Materials',
            'menuMaterials'    => 'active',
            'divisions'        => $divisions,
            'selectedDivision' => $selectedDivision,
            'materials'        => $materials,
        );
        return view('pelatih.materials', $data);
    }

    public function createMaterial()
    {
        $divisions = \App\Models\Division::all();
        $data = array(
            'title'         => 'Tambah Materi',
            'menuMaterials' => 'active',
            'divisions'     => $divisions,
        );
        return view('pelatih.add-materials', $data);
    }

    public function storeMaterial(Request $request)
    {
        $request->validate([
            'judul_bab'     => 'required|string|max:255',
            'deskripsi_bab' => 'nullable|string',
            'division_id'   => 'required|exists:divisions,id_division',
            'file_materi.*' => 'nullable|file|max:51200',
        ]);

        $material = Material::create([
            'title'       => $request->judul_bab,
            'description' => $request->deskripsi_bab,
            'uploaded_by' => auth()->user()->id_user,
            'division_id' => $request->division_id,
        ]);

        if ($request->hasFile('file_materi')) {
            foreach ($request->file('file_materi') as $file) {
                $ext      = $file->getClientOriginalExtension();
                $name     = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $name);
                $fileName = uniqid() . '_' . $safeName . '.' . $ext;
                $filePath = \App\Helpers\StorageHelper::storeAs($file, 'materials', $fileName);

                \App\Models\MaterialFile::create([
                    'material_id' => $material->id_material,
                    'file_type'   => $ext,
                    'file_path'   => $filePath,
                    'file_name'   => $file->getClientOriginalName(), // simpan nama asli untuk display
                ]);
            }
        }

        return redirect()->route('pelatih.materials')->with('success', 'Materi berhasil ditambahkan');
    }

    public function editMaterial($id)
    {
        $material = Material::with('files')->findOrFail($id);
        $divisions = \App\Models\Division::all();

        $data = array(
            'title'         => 'Edit Materi',
            'menuMaterials' => 'active',
            'material'      => $material,
            'divisions'     => $divisions,
        );
        return view('pelatih.edit-materials', $data);
    }

    public function updateMaterial(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        $request->validate([
            'judul_bab'     => 'required|string|max:255',
            'deskripsi_bab' => 'nullable|string',
            'file_materi.*' => 'nullable|file|max:51200',
        ]);

        $request->validate([
            'division_id' => 'required|exists:divisions,id_division',
        ]);

        $material->update([
            'title'       => $request->judul_bab,
            'description' => $request->deskripsi_bab,
            'division_id' => $request->division_id,
        ]);

        // Hapus file yang dicentang
        if ($request->has('delete_files')) {
            $filesToDelete = \App\Models\MaterialFile::whereIn('id_material_file', $request->delete_files)->get();
            foreach ($filesToDelete as $file) {
                \App\Helpers\StorageHelper::delete($file->file_path);
                $file->delete();
            }
        }

        // Upload file baru
        if ($request->hasFile('file_materi')) {
            foreach ($request->file('file_materi') as $file) {
                $ext      = $file->getClientOriginalExtension();
                $name     = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $name);
                $fileName = uniqid() . '_' . $safeName . '.' . $ext;
                $filePath = \App\Helpers\StorageHelper::storeAs($file, 'materials', $fileName);

                \App\Models\MaterialFile::create([
                    'material_id' => $material->id_material,
                    'file_type'   => $ext,
                    'file_path'   => $filePath,
                    'file_name'   => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('pelatih.materials')->with('success', 'Materi berhasil diperbarui');
    }

    public function destroyMaterial($id)
    {
        $material = Material::with('files')->findOrFail($id);

        foreach ($material->files as $file) {
            \App\Helpers\StorageHelper::delete($file->file_path);
        }

        $material->delete();

        return redirect()->route('pelatih.materials')->with('success', 'Materi berhasil dihapus');
    }
}
