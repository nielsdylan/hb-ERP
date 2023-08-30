<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //1
        DB::table('accesos')->insert([
            'descripcion'       => 'VER LISTA DE ALUMNOS',
            'menu_id'           => 5,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'NUEVO ALUMNO',
            'menu_id'           =>5,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'EDITAR ALUMNO',
            'menu_id'           =>5,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ELIMINAR ALUMNO',
            'menu_id'           =>5,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'CARGA MASIVA DE ALUMNOS',
            'menu_id'           =>5,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'MODELO DE EXCEL ALUMNO',
            'menu_id'           =>5,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'VER PERFIL DE ALUMNO',
            'menu_id'           =>5,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        // DOCENTES
        DB::table('accesos')->insert([
            'descripcion'       => 'VER LISTA DE DOCENTES',
            'menu_id'           =>2,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'NUEVO DOCENTE',
            'menu_id'           =>2,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'EDITAR DOCENTE',
            'menu_id'           =>2,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ELIMINAR DOCENTE',
            'menu_id'           =>2,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        // CURSOS
        DB::table('accesos')->insert([
            'descripcion'       => 'VER LISTA DE CURSOS',
            'menu_id'           =>3,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'NUEVO CURSO',
            'menu_id'           =>3,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'EDITAR CURSO',
            'menu_id'           =>3,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ELIMINAR CURSO',
            'menu_id'           =>3,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        // AULAS
        DB::table('accesos')->insert([
            'descripcion'       => 'VER LISTA DE AULAS',
            'menu_id'           =>4,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'NUEVO AULA',
            'menu_id'           =>4,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'EDITAR AULA',
            'menu_id'           =>4,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ELIMINAR AULA',
            'menu_id'           =>4,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ASISTENCIA DE ALUMNOS DEL AULA',
            'menu_id'           =>4,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'AGREGAR ALUMNO AL AULA',
            'menu_id'           =>4,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        // EMPRESAS
        DB::table('accesos')->insert([
            'descripcion'       => 'VER LISTA DE EMPRESAS',
            'menu_id'           =>6,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'NUEVO EMPRESA',
            'menu_id'           =>6,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'EDITAR EMPRESA',
            'menu_id'           =>6,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ELIMINAR EMPRESA',
            'menu_id'           =>6,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
