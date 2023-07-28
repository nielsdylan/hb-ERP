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


        //2
        DB::table('usuarios')->insert([
            'nombre_corto'      => 'NIELS QUISPE',
            'email'             => 'niels@hotmail.com',
            'password'          => Hash::make('password'),
            'avatar_imagen'   => '',
            'avatar_initials'   => 'NQ',
            'persona_id'   => 2,
            'empresa_id'   => 2,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        //3
        DB::table('usuarios')->insert([
            'nombre_corto'      => 'WENDY ZUÑIGA',
            'email'             => 'wendy@hotmail.com',
            'password'          => Hash::make('password'),
            'avatar_imagen'   => '',
            'avatar_initials'   => 'WZ',
            'persona_id'   => 3,
            'empresa_id'   => 3,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        //4
        DB::table('usuarios')->insert([
            'nombre_corto'      => 'JORGE MEDINA',
            'email'             => 'jorge@hotmail.com',
            'password'          => Hash::make('password'),
            'avatar_imagen'   => '',
            'avatar_initials'   => 'JM',
            'persona_id'   => 4,
            'empresa_id'   => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
