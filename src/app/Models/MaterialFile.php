<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialFile extends Model
{
    protected $table = 'material_files';

    protected $primaryKey = 'id_material_file';

    protected $fillable = [
        'material_id',
        'file_type',
        'file_path',
        'file_name'
    ];

    public function material()
    {
        return $this->belongsTo(
            Material::class,
            'material_id',
            'id_material'
        );
    }
}