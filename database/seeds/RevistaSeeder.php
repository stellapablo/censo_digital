<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RevistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('revista')->insert([
            'nombre' => 'Planta',
        ]);
        DB::table('revista')->insert([
            'nombre' => 'Localización de Servicio',
        ]);
        DB::table('revista')->insert([
            'nombre' => 'Jornalizado',
        ]);
        DB::table('revista')->insert([
            'nombre' => 'Consultor',
        ]);
        DB::table('revista')->insert([
            'nombre' => 'Concejal',
        ]);
        DB::table('revista')->insert([
            'nombre' => 'Jubilado',
        ]);
        DB::table('revista')->insert([
            'nombre' => 'Personal de Gabinete',
        ]);
        DB::table('revista')->insert([
            'nombre' => 'Autoridad Superior con Cargo Electivo',
        ]);
        DB::table('revista')->insert([
            'nombre' => 'Docente',
        ]);

    }
}
