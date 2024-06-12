<?php

namespace Database\Seeders;

use App\Models\Traitement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TraitementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Traitement::factory()->count(15)->create();
    }
}
