<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id_role';
    protected $fillable = ['role_name'];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_roles', 
            'id_role', 
            'id_user');
    }

    public static function label(string $roleName): string
    {
        return match($roleName) {
            'superadmin'  => 'Super Admin',
            'admin'       => 'Admin',
            'ketua_tim'   => 'Ketua Tim',
            'pelatih'     => 'Pelatih',
            'anggota_tim' => 'Anggota Tim',
            default       => ucfirst($roleName),
        };
    }

}
