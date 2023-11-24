<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accesos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'accesos';
    protected $fillable = ['descripcion','numero', 'fecha_registro', 'menu_id', 'estado','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
