<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Api;
use App\Models\Liste;
use App\Models\FilmListe;
use App\Models\RatingFilm;
use App\Models\Film;
use App\Models\User;

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

        $userRating = RatingFilm::where('user_id', auth()->id())
                        ->where('film_id', $apiData->id)
                        ->value('rating');

        return view('films.details', compact('userRating'), ['film' => $apiData, 'lists' => $lists, 'checkedLists' => $checkedLists, 'elementId' => $apiData->id, 'elementType' => 'film']);
    }

    public function addRating(Request $request, $filmId)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->ratedFilms()->syncWithoutDetaching([$filmId => ['rating' => $request->input('rating')]]);

        return response()->json(['success' => 'Rating updated successfully.']);
    }

    public function getAverageRating($filmId)
    {
        $film = Film::findOrFail($filmId);

        // Calculez la nouvelle moyenne des évaluations pour le film
        $averageRating = $film->ratings->avg('rating');

        return response()->json(['averageRating' => $averageRating]);
    }
}
