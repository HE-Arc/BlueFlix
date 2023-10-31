<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FilmListe;

class FilmListeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        FilmListe::create([
            'liste_id' => 1,
            'film_id' => 1,
        ]);

        FilmListe::create([
            'liste_id' => 1,
            'film_id' => 2,
        ]);

        FilmListe::create([
            'liste_id' => 2,
            'film_id' => 3,
        ]);

        FilmListe::create([
            'liste_id' => 3,
            'film_id' => 1,
        ]);

        FilmListe::create([
            'liste_id' => 3,
            'film_id' => 2,
        ]);

        FilmListe::create([
            'liste_id' => 3,
            'film_id' => 3,
        ]);
    }
}
