<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Api extends Model
{
    use HasFactory;

    public static function getFilmDetails($id)
    {
        $apiKey = env('API_KEY');
        $url = env('API_URL');
        $url_image = env('API_IMAGE_URL');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url . "/movie/" . $id);

        $jsonData = json_decode($response);

        if ($jsonData) {
            $film = Film::where('id', $jsonData->id)->first();

            if ($film === null) {
                // Si le film n'existe pas, ajoutez-le à la base de données
                $film = new Film();
                $film->id = $jsonData->id;
            }

            // Mettez à jour les propriétés du film avec les nouvelles données
            $film->nom = $jsonData->title;
            $film->date_sortie = $jsonData->release_date;
            $film->urlImage = $url_image . $jsonData->poster_path;

            $film->save();

            return $film;
        }

        return null;
    }

    public static function getSerieDetails($id)
    {
        $apiKey = env('API_KEY');
        $url = env('API_URL');
        $url_image = env('API_IMAGE_URL');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url . "/tv/" . $id);

        $jsonData = json_decode($response);

        if ($jsonData) {
            $serie = Serie::where('id', $jsonData->id)->first();

            if ($serie === null) {
                // Si la serie n'existe pas, ajoutez-le à la base de données
                $serie = new Serie();
                $serie->id = $jsonData->id;
            }

            // Mettez à jour les propriétés du film avec les nouvelles données
            $serie->nom = $jsonData->name;
            $serie->date_sortie = $jsonData->first_air_date;
            $serie->urlImage = $url_image . $jsonData->poster_path;

            $serie->save();

            return $serie;
        }

        return null;
    }
}
