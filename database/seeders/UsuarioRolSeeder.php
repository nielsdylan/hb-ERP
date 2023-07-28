<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //1
        DB::table('usuarios_roles')->insert([
            'usuario_id'     => 1,
            'rol_id'         => 1,
            'created_at'            => date('Y-m-d H:i:s'),
            'updated_at'            => date('Y-m-d H:i:s'),
        ]);
        //2
        DB::table('usuarios_roles')->insert([
            'usuario_id'     => 2,
            'rol_id'         => 2,
            'created_at'            => date('Y-m-d H:i:s'),
            'updated_at'            => date('Y-m-d H:i:s'),
        ]);
        //3
        DB::table('usuarios_roles')->insert([
            'usuario_id'     => 3,
            'rol_id'         => 2,
            'created_at'            => date('Y-m-d H:i:s'),
            'updated_at'            => date('Y-m-d H:i:s'),
        ]);
        //4
        DB::table('usuarios_roles')->insert([
            'usuario_id'     => 4,
            'rol_id'         => 3,
            'created_at'            => date('Y-m-d H:i:s'),
            'updated_at'            => date('Y-m-d H:i:s'),
        ]);
    }
}
