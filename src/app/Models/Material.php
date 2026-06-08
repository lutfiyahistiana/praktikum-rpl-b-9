<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';

    protected $primaryKey = 'id_material';

    protected $fillable = [
        'title',
        'description',
        'uploaded_by'
    ];

    public function uploader()
    {
        return $this->belongsTo(
            User::class,
            'uploaded_by',
            'id_user'
        );
    }

    public function files()
    {
        return $this->hasMany(
            MaterialFile::class,
            'material_id',
            'id_material'
        );
    }
}