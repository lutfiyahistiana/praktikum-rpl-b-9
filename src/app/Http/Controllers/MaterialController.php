<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\MaterialFile;

class MaterialController extends Controller
{
    // GET /materials — lihat semua materi
    public function index(Request $request)
    {
        $user = $request->user();
        $userRoles = $user->roles->pluck('role_name')->toArray();

        $isPrivileged = array_intersect(['admin', 'superadmin', 'ketua_tim', 'pelatih'], $userRoles);

        if ($isPrivileged) {
            // Admin, superadmin, ketua_tim, pelatih lihat semua
            $materials = Material::with(['uploader', 'files'])->get();
        } else {
            // Anggota hanya lihat materi divisi mereka
            $divisionMember = \App\Models\DivisionMember::where('anggota_id', $user->id_user)->first();
            if ($divisionMember) {
                $materials = Material::with(['uploader', 'files'])
                    ->where('division_id', $divisionMember->division_id)
                    ->get();
            } else {
                $materials = collect();
            }
        }

        return response()->json([
            'success' => true,
            'data'    => $materials,
        ]);
    }

    // GET /materials/{id} — detail materi
    public function show($id)
    {
        $material = Material::with(['uploader', 'files'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $material,
        ]);
    }

    // POST /materials — upload materi baru
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'files'       => 'nullable|array',
            'files.*'     => 'file|max:10240', // max 10MB per file
        ]);

        $material = Material::create([
            'title'       => $request->title,
            'description' => $request->description,
            'uploaded_by' => $request->user()->id_user,
        ]);

        // Upload files jika ada
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = $file->getClientOriginalName();
                $filePath = \App\Helpers\StorageHelper::store($file, 'materials');
                $fileType = $file->getClientMimeType();

                MaterialFile::create([
                    'material_id' => $material->id_material,
                    'file_name'   => $fileName,
                    'file_path'   => $filePath,
                    'file_type'   => $fileType,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Materi berhasil diupload',
            'data'    => $material->load('files'),
        ], 201);
    }

    // DELETE /materials/{id} — hapus materi
    public function destroy($id)
    {
        $material = Material::with('files')->findOrFail($id);

        // Hapus file fisik dari storage sebelum hapus record
        foreach ($material->files as $file) {
            \App\Helpers\StorageHelper::delete($file->file_path);
        }

        $material->delete(); // DB records terhapus otomatis karena onDelete cascade

        return response()->json([
            'success' => true,
            'message' => 'Materi berhasil dihapus',
        ]);
    }

    // GET /materials/download/{id} — force download file materi
    public function download($id)
    {
        $file = MaterialFile::findOrFail($id);
        $url = \App\Helpers\StorageHelper::url($file->file_path);
        return redirect($url);
    }
}