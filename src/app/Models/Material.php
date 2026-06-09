<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materials';
    protected $primaryKey = 'id_material';

    protected $fillable = [
        'title',
        'description',
        'uploaded_by',
    ];

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'id_user');
    }

    public function files()
    {
        return $this->hasMany(MaterialFile::class, 'material_id', 'id_material');
    }
}
