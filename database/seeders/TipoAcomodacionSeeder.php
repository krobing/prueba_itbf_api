<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoAcomodacionSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_acomodacions')->insert([
            'tipo' => 'Estándar',
            'acomodacion' => 'Sencilla'
        ],[
            'tipo' => 'Estándar',
            'acomodacion' => 'Doble'
        ],[
            'tipo' => 'Junior',
            'acomodacion' => 'Triple'
        ],[
            'tipo' => 'Junior',
            'acomodacion' => 'Cuádruple'
        ],[
            'tipo' => 'Suite',
            'acomodacion' => 'Sencilla'
        ],[
            'tipo' => 'Suite',
            'acomodacion' => 'Doble'
        ],[
            'tipo' => 'Suite',
            'acomodacion' => 'Triple'
        ]);
    }
}
