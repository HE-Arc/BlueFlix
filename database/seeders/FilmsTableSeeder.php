<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Film;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Film::create([
            'nom' => 'Film trop cool',
            'date_sortie' => '2023-10-08',
            'urlImage' => 'https://picsum.photos/200/300',
            'created_at' => '2023-10-17 14:34:43',
            'updated_at' => '2023-10-18 14:34:43',
        ]);

        Film::create([
            'nom' => 'Film assez bien',
            'date_sortie' => '2023-10-08',
            'urlImage' => 'https://picsum.photos/200/300',
            'created_at' => '2023-10-17 14:34:43',
            'updated_at' => '2023-10-18 14:34:43',
        ]);

        Film::create([
            'nom' => 'Film bof',
            'date_sortie' => '2023-10-08',
            'urlImage' => 'https://picsum.photos/200/300',
            'created_at' => '2023-10-17 14:34:43',
            'updated_at' => '2023-10-18 14:34:43',
        ]);
    }
}
