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
        $api_language = env('API_LANGUAGE');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url . "/movie/" . $id . "?language=" . $api_language);

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
        $api_language = env('API_LANGUAGE');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url . "/tv/" . $id . "?language=" . $api_language);

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

    public static function getFilmsList($query, $page = 1)
    {
        if ($query === null) {
            return null;
        }

        $apiKey = env('API_KEY');
        $url = env('API_URL');
        $url_image = env('API_IMAGE_URL');
        $api_language = env('API_LANGUAGE');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url . "/search/movie?query=" . $query . "&language=" . $api_language . "&page=" . $page);

        $jsonData = json_decode($response);

        if ($jsonData) {
            $films = [];

            foreach ($jsonData->results as $film) {
                $newfilm = new Film();
                $newfilm->id = $film->id;
                $newfilm->nom = $film->title;
                $newfilm->date_sortie = $film->release_date;
                $newfilm->urlImage = $url_image . $film->poster_path;

                $films[] = $newfilm;
            }

            return $films;
        }

        return null;
    }

    public static function getSeriesList($query, $page = 1)
    {
        if ($query === null) {
            return null;
        }

        $apiKey = env('API_KEY');
        $url = env('API_URL');
        $url_image = env('API_IMAGE_URL');
        $api_language = env('API_LANGUAGE');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url . "/search/tv?query=" . $query . "&language=" . $api_language . "&page=" . $page);

        $jsonData = json_decode($response);

        if ($jsonData) {
            $series = [];

            foreach ($jsonData->results as $serie) {
                $newserie = new Serie();
                $newserie->id = $serie->id;
                $newserie->nom = $serie->name;
                $newserie->date_sortie = $serie->first_air_date;
                $newserie->urlImage = $url_image . $serie->poster_path;

                $series[] = $serie;
            }

            return $series;
        }

        return null;
    }
}
