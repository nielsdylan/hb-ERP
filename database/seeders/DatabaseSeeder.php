<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->truncateTables([
        //     'tipo_documentos',
        //     'usuarios',
        // ]);
        $this->call([
            EmpresaSeeder::class,
            LogTipoActividadSeeder::class,
            TipoDocumentoSeeder::class,
            PersonaSeeder::class,
            UsuarioSeeder::class,
        ]);
    }
    // protected function truncateTables(array $tables)
    // {
    //     foreach ($tables as $table)
    //     {
    // 		DB::table($table)->truncate();
    // 	}
    // }
}
