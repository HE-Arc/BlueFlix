<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Api;
use App\Models\Liste;
use App\Models\FilmListe;
use App\Models\RatingFilm;
use App\Models\Film;

class FilmController extends Controller
{
    /**
     * Display the details of a film.
     *
     * @param int $id Film ID
     * @return \Illuminate\Contracts\View\View
     */
    public function showFilm($id)
    {
        // Retrieve film details from the external API
        $apiData = Api::getFilmDetails($id);

        // Check if the user is authenticated
        if (Auth::check()) {
            // Query user's lists
            $query = Liste::where('user_id', auth()->user()->id);
            $lists = $query->select('id', 'nom')->get();

            // Checklists for films that are already in the user's lists
            $checkedLists = FilmListe::whereIn('liste_id', $query->select('id'))->where('film_id', $id)->select('liste_id')->get();
            $checkedLists = $checkedLists->pluck('liste_id')->toArray();
        } else {
            // User is not authenticated, initialize empty lists
            $lists = [];
            $checkedLists = [];
        }

        // Retrieve user's rating for the film
        $userRating = RatingFilm::where('user_id', auth()->id())
            ->where('film_id', $apiData->id)
            ->value('rating');

        // Pass data to the view
        return view('films.details', compact('userRating'), [
            'film' => $apiData,
            'lists' => $lists,
            'checkedLists' => $checkedLists,
            'elementId' => $apiData->id,
            'elementType' => 'film'
        ]);
    }

    /**
     * Add or update the user's rating for a film.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $filmId Film ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRating(Request $request, $filmId)
    {
        // Validate the incoming request
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        // Retrieve the authenticated user
        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Sync the user's rating for the film
        $user->ratedFilms()->syncWithoutDetaching([$filmId => ['rating' => $request->input('rating')]]);

        // Return a success JSON response
        return response()->json(['success' => 'Rating updated successfully.']);
    }

    /**
     * Get the average rating for a film.
     *
     * @param int $filmId Film ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAverageRating($filmId)
    {
        // Find the film by ID
        $film = Film::findOrFail($filmId);

        // Calculate the average rating for the film
        $averageRating = $film->ratings->avg('rating');

        // Return a JSON response with the average rating
        return response()->json(['averageRating' => $averageRating]);
    }
}
