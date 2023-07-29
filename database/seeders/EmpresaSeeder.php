<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //1
        DB::table('empresas')->insert([
            'tipo_documento_id' => 1,
            'ruc' => '1111111',
            'razon_social' => 'HB GROUP PERU E.I.R.L.',
            'direccion' => 'DIRECCION 1',
            'email' => 'HB@HOTMAIL.COM',
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        //2
        DB::table('empresas')->insert([
            'tipo_documento_id' => 1,
            'ruc' => '2222222',
            'razon_social' => 'CALICOM',
            'direccion' => 'DIRECCION 2',
            'email' => 'CALICOM@HOTMAIL.COM',
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        //3
        DB::table('empresas')->insert([
            'tipo_documento_id' => 1,
            'ruc' => '3333333',
            'razon_social' => 'TRIZCON-SICOIN',
            'direccion' => 'DIRECCION 3',
            'email' => 'TRIZCON@HOTMAIL.COM',
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        //4
        DB::table('empresas')->insert([
            'tipo_documento_id' => 1,
            'ruc' => '444444',
            'razon_social' => 'TRANSALTISA SA',
            'direccion' => 'DIRECCION 4',
            'email' => 'TRANSALTISA@HOTMAIL.COM',
            'fecha_registro'    => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
