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
            'tipo_documento_id' => 2,
            'nro_documento'     => '99999999',
            'name'              => 'INFO',
            'last_name'         => 'HBGROUP',
            'avatar_image'      => '',
            'avatar_initials'   => 'IN',
            'email'             => 'info@hbgroup.pe',
            'password'          => Hash::make('password'),
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'fecha_cumpleaños'  => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
