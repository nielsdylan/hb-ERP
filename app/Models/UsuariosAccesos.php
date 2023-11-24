<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuariosAccesos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'usuarios_accesos';
    protected $fillable = ['usuario_id','acceso_id', 'menu_id', 'estado','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
