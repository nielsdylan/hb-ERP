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
            'nombre_corto'      => 'INFO',
            'nro_documento'         => '99999999',
            'email'             => 'info@hbgroup.pe',
            'password'          => Hash::make('password'),
            // 'avatar_imagen'   => '',
            'avatar_initials'   => 'IN',
            'persona_id'   => 1,
            'empresa_id'   => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);


        //2
        DB::table('usuarios')->insert([
            'nombre_corto'      => 'ADMINISTRADOR',
            'nro_documento'         => '74250891',
            'email'             => 'niels_dylan@hotmail.com',
            'password'          => Hash::make('74250891'),
            // 'avatar_imagen'   => '',
            'avatar_initials'   => 'AD',
            'persona_id'   => 2,
            'empresa_id'   => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        //3
        DB::table('usuarios')->insert([
            'nombre_corto'      => 'Annie Bejarano',
            'nro_documento'         => '75168303',
            'email'             => 'comercial@hbgroup.pe',
            'password'          => Hash::make('75168303'),
            // 'avatar_imagen'   => '',
            'avatar_initials'   => 'AB',
            'persona_id'   => 3,
            'empresa_id'   => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        //4
        DB::table('usuarios')->insert([
            'nombre_corto'      => 'Laura Villavicencio',
            'nro_documento'         => '75165161',
            'email'             => 'servicio@hbgroup.pe',
            'password'          => Hash::make('75165161'),
            // 'avatar_imagen'   => '',
            'avatar_initials'   => 'LV',
            'persona_id'   => 4,
            'empresa_id'   => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        //5
        DB::table('usuarios')->insert([
            'nombre_corto'      => 'HELARD BEJARANO',
            'nro_documento'         => '46497055',
            'email'             => 'hbejarano@southernperu.com',
            'password'          => Hash::make('46497055'),
            // 'avatar_imagen'   => '',
            'avatar_initials'   => 'HB',
            'persona_id'   => 5,
            'empresa_id'   => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
