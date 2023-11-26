<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //1
        DB::table('tipo_documentos')->insert([
            'codigo'            => 'RUC',
            'descripcion'       => 'REGISTRO ÚNICO DE CONTRIBUYENTES',
            'fecha_registro'    => date('Y-m-d'),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        //2
        DB::table('tipo_documentos')->insert([
            'codigo'            => 'DNI',
            'descripcion'       => 'DOCUMENTO NACIONAL DE IDENTIDAD',
            'fecha_registro'    => date('Y-m-d'),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
