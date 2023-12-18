<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api;

class HomeController extends Controller
{
    /**
     * Display the home page with a list of discover films and series.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Retrieve a list of discover films from the external API
        $filmsList = Api::getDiscoverFilms();

        // Retrieve a list of discover series from the external API
        $seriesList = Api::getDiscoverSeries();

        return view('home', compact('filmsList', 'seriesList'));
    }
}
