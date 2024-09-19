<?php

namespace Database\Seeders;

use App\Models\Race;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Race::create([
            'name' => 'Humain'
        ]);

        Race::create([
            'name' => 'Orc'
        ]);

        Race::create([
            'name' => 'Tauren'
        ]);
    }
}
