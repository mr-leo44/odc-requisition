<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Approbateur extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('approbateurs')->insert([
            [
                'level' => 1,
                'name' => 'Jemima',
                'fonction' => 'Magasin',
                'email' => 'jemimaafidou20@gmail.com'
            ],
            [
                'level' => 2,
                'name' => 'Manasse',
                'fonction' => 'Responsable Moyens Généraux',
                'email' => 'manassetshims@gmail.com'
            ],
            [
                'level' => 3,
                'name' => 'Olivia',
                'fonction' => 'Chef de Département Achat et Logistique',
                'email' => 'oliviapala16@gmail.com'
            ],
        ]);
    }
}
