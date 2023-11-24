<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    protected $table = 'usuarios';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_corto',
        'email',
        'avatar_imagen',
        'avatar_initials',
        'persona_id',
        'empresa_id',
        'fecha_registro',
        'fecha_cumpleaños', 'estado',
        
        'created_id',
        'updated_id',
        'deleted_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Personas::class);
    }
    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresas::class);
    }
}
