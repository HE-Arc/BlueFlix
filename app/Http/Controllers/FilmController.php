<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Api;
use App\Models\Liste;
use App\Models\FilmListe;

class FilmController extends Controller
{
    public function showFilm($id)
    {
        $apiData = Api::getFilmDetails($id);
        if(Auth::check()) {
            $query = Liste::where('user_id', auth()->user()->id);
            $lists = $query->select('id', 'nom')->get();
            $checkedLists = FilmListe::whereIn('liste_id', $query->select('id'))->where('film_id', $id)->select('liste_id')->get();
            $checkedLists = $checkedLists->pluck('liste_id')->toArray();
        } else {
            $lists = [];
            $checkedLists = [];
        }
        return view('films.details', ['film' => $apiData, 'lists' => $lists, 'checkedLists' => $checkedLists, 'elementId' => $apiData->id, 'elementType' => 'film']);
    }
}
