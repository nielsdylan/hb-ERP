<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuariosRoles extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'usuarios_roles';
    protected $fillable = ['usuario_id','rol_id', 'estado','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
}
