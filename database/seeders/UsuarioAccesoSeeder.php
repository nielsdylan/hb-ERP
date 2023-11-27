<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioAccesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //info
            //empresas
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 22,
                'menu_id'           => 6,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 23,
                'menu_id'           => 6,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 24,
                'menu_id'           => 6,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 25,
                'menu_id'           => 6,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            //docente -------------------------------------
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 8,
                'menu_id'           => 2,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 9,
                'menu_id'           => 2,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 10,
                'menu_id'           => 2,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 11,
                'menu_id'           => 2,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            //cursos -------------------------------------
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 12,
                'menu_id'           => 3,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 13,
                'menu_id'           => 3,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 14,
                'menu_id'           => 3,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 15,
                'menu_id'           => 3,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            //aulas -------------------------------------
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 16,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 17,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 18,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 19,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 20,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 21,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);


            //alumnos -------------------------------------
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 1,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 2,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 3,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 4,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 5,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 6,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 1,
                'acceso_id'         => 7,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

        // admin

            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 22,
                'menu_id'           => 6,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 23,
                'menu_id'           => 6,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 24,
                'menu_id'           => 6,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 25,
                'menu_id'           => 6,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            //docente -------------------------------------
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 8,
                'menu_id'           => 2,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 9,
                'menu_id'           => 2,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 10,
                'menu_id'           => 2,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 11,
                'menu_id'           => 2,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            //cursos -------------------------------------
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 12,
                'menu_id'           => 3,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 13,
                'menu_id'           => 3,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 14,
                'menu_id'           => 3,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 15,
                'menu_id'           => 3,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            //aulas -------------------------------------
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 16,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 17,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 18,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 19,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 20,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 21,
                'menu_id'           => 4,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);


            //alumnos -------------------------------------
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 1,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 2,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 3,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 4,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 5,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            //1
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 6,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
            DB::table('usuarios_accesos')->insert([
                'usuario_id'        => 2,
                'acceso_id'         => 7,
                'menu_id'           => 5,
                'created_id'        => 1,
                'updated_id'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);
    }
}
