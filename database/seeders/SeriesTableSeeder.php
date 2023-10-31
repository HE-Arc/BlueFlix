<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Serie;

class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Serie::create([
            'nom' => 'Serie sympa',
            'date_sortie' => '2023-10-04',
            'urlImage' => 'https://picsum.photos/200/300',
            'created_at' => '2023-10-09 14:38:20',
            'updated_at' => '2023-10-11 14:38:20',
        ]);

        Serie::create([
            'nom' => 'Serie machin',
            'date_sortie' => '2023-10-04',
            'urlImage' => 'https://picsum.photos/200/300',
            'created_at' => '2023-10-09 14:38:20',
            'updated_at' => '2023-10-11 14:38:20',
        ]);

        Serie::create([
            'nom' => 'Serie truc',
            'date_sortie' => '2023-10-04',
            'urlImage' => 'https://picsum.photos/200/300',
            'created_at' => '2023-10-09 14:38:20',
            'updated_at' => '2023-10-11 14:38:20',
        ]);
    }
}
