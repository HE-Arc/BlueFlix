<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api;

class FilmController extends Controller
{
    public function showFilm($id)
    {
        $apiData = Api::getFilmDetails($id);

        return view('films.details', ['film' => $apiData]);
    }
}
