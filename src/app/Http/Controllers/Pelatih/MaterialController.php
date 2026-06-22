<?php

namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Material;

class MaterialController extends Controller
{
    public function showMaterials()
    {
        $materials = Material::with('files')->get();

        $data = array(
            'title'         => 'Materials',
            'menuMaterials' => 'active',
            'materials'     => $materials
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
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('materials', $fileName, 'public');

                \App\Models\MaterialFile::create([
                    'material_id' => $material->id_material,
                    'file_type'   => $file->getClientOriginalExtension(),
                    'file_path'   => $filePath,
                    'file_name'   => $file->getClientOriginalName(),
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
                \Illuminate\Support\Facades\Storage::disk('public')->delete($file->file_path);
                $file->delete();
            }
        }

        // Upload file baru
        if ($request->hasFile('file_materi')) {
            foreach ($request->file('file_materi') as $file) {
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('materials', $fileName, 'public');

                \App\Models\MaterialFile::create([
                    'material_id' => $material->id_material,
                    'file_type'   => $file->getClientOriginalExtension(),
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

        // Hapus semua file fisik
        foreach ($material->files as $file) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($file->file_path);
        }

        $material->delete();

        return redirect()->route('pelatih.materials')->with('success', 'Materi berhasil dihapus');
    }
}
