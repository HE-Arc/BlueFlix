<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api;

class HomeController extends Controller
{
    public function index() {
        $filmsList = Api::getDiscoverFilms();
        $seriesList = Api::getDiscoverSeries();

        return view('home', compact('filmsList', 'seriesList'));
    }
}
