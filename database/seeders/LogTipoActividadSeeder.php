<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogTipoActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //
        DB::table('log_tipo_actividades')->insert([
            'descripcion'   => 'Ha ingresado a ver el listado',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);
        DB::table('log_tipo_actividades')->insert([
            'descripcion'   => 'Ha accedido al formulario',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);

        DB::table('log_tipo_actividades')->insert([
            'descripcion'   => 'Ha ingresado un registro en la tabla',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);

        DB::table('log_tipo_actividades')->insert([
            'descripcion'   => 'Ha modificado un registro en la tabla',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);

        DB::table('log_tipo_actividades')->insert([
            'descripcion'   => 'Ha eliminado un registro en la tabla',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);

        DB::table('log_tipo_actividades')->insert([
            'descripcion'   => 'Ha realizado una búsqueda',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);

        DB::table('log_tipo_actividades')->insert([
            'descripcion'   => 'Ha realizado una descarga de archivos',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'created_id'   => 1,
            'updated_id'   => 1,
        ]);
    }
}
