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
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'NUEVO ALUMNO',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'EDITAR ALUMNO',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ELIMINAR ALUMNO',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'CARGA MASIVA DE ALUMNOS',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'MODELO DE EXCEL ALUMNO',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'VER PERFIL DE ALUMNO',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        // DOCENTES
        DB::table('accesos')->insert([
            'descripcion'       => 'VER LISTA DE DOCENTES',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'NUEVO DOCENTE',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'EDITAR DOCENTE',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ELIMINAR DOCENTE',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        // CURSOS
        DB::table('accesos')->insert([
            'descripcion'       => 'VER LISTA DE CURSOS',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'NUEVO CURSO',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'EDITAR CURSO',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ELIMINAR CURSO',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        // AULAS
        DB::table('accesos')->insert([
            'descripcion'       => 'VER LISTA DE AULAS',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'NUEVO AULA',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'EDITAR AULA',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ELIMINAR AULA',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ASISTENCIA DE ALUMNOS DEL AULA',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'AGREGAR ALUMNO AL AULA',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        // EMPRESAS
        DB::table('accesos')->insert([
            'descripcion'       => 'VER LISTA DE EMPRESAS',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'NUEVO EMPRESA',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'EDITAR EMPRESA',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        DB::table('accesos')->insert([
            'descripcion'       => 'ELIMINAR EMPRESA',
            // 'numero'            => 1,
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
