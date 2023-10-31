<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Liste;

class ListesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Liste::create([
            'nom' => 'SuperListe',
            'urlImage' => 'https://picsum.photos/200',
            'user_id' => 1,
        ]);

        Liste::create([
            'nom' => 'Franchement nul',
            'urlImage' => 'https://picsum.photos/200',
            'user_id' => 1,
        ]);

        Liste::create([
            'nom' => 'A regarder',
            'urlImage' => 'https://picsum.photos/200',
            'user_id' => 2,
        ]);
    }
}
