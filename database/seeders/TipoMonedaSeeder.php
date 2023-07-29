<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        //1
        DB::table('tipo_monedas')->insert([
            'descripcion' => 'SOLES',
            'simbolo' => 'S/.',
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        //2
        DB::table('tipo_monedas')->insert([
            'descripcion'   => 'DOLAR',
            'simbolo'       => '$',
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
