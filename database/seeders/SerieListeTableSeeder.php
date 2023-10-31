<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SerieListe;

class SerieListeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        SerieListe::create([
            'liste_id' => 1,
            'serie_id' => 1,
        ]);

        SerieListe::create([
            'liste_id' => 2,
            'serie_id' => 2,
        ]);

        SerieListe::create([
            'liste_id' => 2,
            'serie_id' => 3,
        ]);

        SerieListe::create([
            'liste_id' => 3,
            'serie_id' => 1,
        ]);

        SerieListe::create([
            'liste_id' => 3,
            'serie_id' => 2,
        ]);

        SerieListe::create([
            'liste_id' => 3,
            'serie_id' => 3,
        ]);
    }
}
