<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //1
        DB::table('usuarios')->insert([
            'nombre_corto'      => 'INFO HBGROUP',
            'email'             => 'info@hbgroup.pe',
            'password'          => Hash::make('password'),
            'avatar_imagen'   => '',
            'avatar_initials'   => 'IN',
            'persona_id'   => 1,
            'empresa_id'   => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
