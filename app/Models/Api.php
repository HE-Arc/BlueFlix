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

        if ($jsonData && isset($jsonData->id)) {
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

            $film->overview = $jsonData->overview;
            $film->runtime = $jsonData->runtime;

            $companyNames = [];

            foreach ($jsonData->production_companies as $company) {
                $companyNames[] = $company->name;
            }

            $film->companyNames = implode(', ', $companyNames);

            $genreNames = [];

            foreach ($jsonData->genres as $genre) {
                $genreNames[] = $genre->name;
            }

            $film->genres = implode(', ', $genreNames);

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

        if ($jsonData && isset($jsonData->id)) {
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

            $serie->overview = $jsonData->overview;
            $serie->runtime = $jsonData->episode_run_time[0];

            $serie->number_of_seasons = $jsonData->number_of_seasons;
            $serie->number_of_episodes = $jsonData->number_of_episodes;

            $companyNames = [];

            foreach ($jsonData->production_companies as $company) {
                $companyNames[] = $company->name;
            }

            $serie->companyNames = implode(', ', $companyNames);

            $genreNames = [];

            foreach ($jsonData->genres as $genre) {
                $genreNames[] = $genre->name;
            }

            $serie->genres = implode(', ', $genreNames);


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
                $newfilm->title = $film->title;
                $newfilm->image = $url_image . $film->poster_path;
                $newfilm->route = route('films.details', ['id' => $film->id]);

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
                $newserie->title = $serie->name;
                $newserie->image = $url_image . $serie->poster_path;
                $newserie->route = route('series.details', ['id' => $serie->id]);

                $series[] = $newserie;
            }

            return $series;
        }

        return null;
    }

    public static function getDiscoverFilms()
    {
        $apiKey = env('API_KEY');
        $url = env('API_URL');
        $url_image = env('API_IMAGE_URL');
        $api_language = env('API_LANGUAGE');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url . "/discover/movie?" . "&language=" . $api_language);

        $jsonData = json_decode($response);

        if ($jsonData) {
            $films = [];

            foreach ($jsonData->results as $film) {
                $newfilm = new Film();
                $newfilm->id = $film->id;
                $newfilm->title = $film->title;
                $newfilm->image = $url_image . $film->poster_path;
                $newfilm->route = route('films.details', ['id' => $film->id]);

                $films[] = $newfilm;
            }

            return $films;
        }
    }

    public static function getDiscoverSeries()
    {
        $apiKey = env('API_KEY');
        $url = env('API_URL');
        $url_image = env('API_IMAGE_URL');
        $api_language = env('API_LANGUAGE');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get($url . "/discover/tv?" . "&language=" . $api_language);

        $jsonData = json_decode($response);

        if ($jsonData) {
            $series = [];

            foreach ($jsonData->results as $serie) {
                $newserie = new Serie();
                $newserie->id = $serie->id;
                $newserie->title = $serie->name;
                $newserie->image = $url_image . $serie->poster_path;
                $newserie->route = route('series.details', ['id' => $serie->id]);

                $series[] = $newserie;
            }

            return $series;
        }
    }
}
