<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //1
        DB::table('personas')->insert([
            'tipo_documento_id'     => 2,
            'nro_documento'         => '9999999',
            'apellido_paterno'      => 'HB',
            'apellido_materno'      => 'GROUP',
            'nombres'               => 'INFO',
            'telefono'              => 9999999,
            'whatsapp'              => 9999999,
            'fecha_cumpleaños'      => date('Y-m-d'),
            'fecha_caducidad_dni'   => date('Y-m-d'),
            'fecha_registro'        => date('Y-m-d H:i:s'),
            'created_at'            => date('Y-m-d H:i:s'),
            'updated_at'            => date('Y-m-d H:i:s'),
        ]);
    }
}
