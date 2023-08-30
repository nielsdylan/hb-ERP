<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //1
        DB::table('menus')->insert([
            'titulo'        => 'Academico',
            'descripcion'   => 'Gestion de menu academico',
            'link'          => '#',
            'padre_id'      => 0,
            // 'target'   => false,
            'hijos'   => true,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);
        //2
        DB::table('menus')->insert([
            'titulo'        => 'Docente',
            'descripcion'   => 'Gestion de Docentes',
            'link'          => '#',
            'padre_id'      => 1,
            // 'target'   => false,
            // 'hijos'   => false,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);
        //3
        DB::table('menus')->insert([
            'titulo'        => 'Cursos',
            'descripcion'   => 'Gestion de Cursos',
            'link'          => '#',
            'padre_id'      => 1,
            // 'target'   => false,
            // 'hijos'   => false,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);
        //4
        DB::table('menus')->insert([
            'titulo'        => 'Aulas',
            'descripcion'   => 'Gestion de Aulas',
            'link'          => '#',
            'padre_id'      => 1,
            // 'target'   => false,
            // 'hijos'   => false,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);
        //5
        DB::table('menus')->insert([
            'titulo'        => 'Alumnos',
            'descripcion'   => 'Gestion de menu Alumnos',
            'link'          => '#',
            'padre_id'      => 1,
            // 'target'   => false,
            // 'hijos'   => false,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);
        //1
        DB::table('menus')->insert([
            'titulo'        => 'Empresas',
            'descripcion'   => 'Gestion de Empresas',
            'link'          => '#',
            'padre_id'      => 0,
            // 'target'   => false,
            // 'hijos'   => true,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);
    }
}
