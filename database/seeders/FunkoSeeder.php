<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FunkoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('funkos')->insert([
            [
                'nombre' => 'iron man',
                'precio' => 10.99,
                'stock' => 5,
                'categoria_id' => 2,
            ],
            [
                'nombre' => 'stitch',
                'precio' => 10.99,
                'stock' => 5,
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'ojo de halcon',
                'precio' => 10.99,
                'stock' => 5,
                'categoria_id' => 2,
            ],
            [
                'nombre' => 'jack sparrow',
                'precio' => 10.99,
                'stock' => 5,
                'categoria_id' => 1,
            ],
        ]);
    }
}
