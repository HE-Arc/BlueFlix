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

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url . "/movie/" . $id);

        $jsonData = json_decode($response);

        if ($jsonData) {
            $film = new Film();

            $film->id = $jsonData->id;
            $film->nom = $jsonData->title;
            $film->date_sortie = $jsonData->release_date;
            $film->urlImage = $jsonData->poster_path;

            return $film;
        }

        return null;
    }

    public static function getSerieDetails($id)
    {
        $apiKey = env('API_KEY');
        $url = env('API_URL');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url . "/tv/" . $id);

        $jsonData = json_decode($response);

        if ($jsonData) {
            $serie = new Serie();

            $serie->id = $jsonData->id;
            $serie->nom = $jsonData->name;
            $serie->date_sortie = $jsonData->first_air_date;
            $serie->urlImage = $jsonData->poster_path;

            return $serie;
        }

        return null;
    }
}
