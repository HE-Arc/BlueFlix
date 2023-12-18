<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Api;
use App\Models\ListClass;
use App\Models\SerieList;
use App\Models\RatingSerie;
use App\Models\Serie;

class SerieController extends Controller
{
    /**
     * Display the details of a TV series.
     *
     * @param int $id Series ID
     * @return \Illuminate\Contracts\View\View
     */
    public function showSerie($id)
    {
        // Get series details from the external API
        $apiData = Api::getSerieDetails($id);

        // Check if the user is authenticated
        if (Auth::check()) {
            // Retrieve user-specific lists
            $query = ListClass::where('user_id', auth()->user()->id);
            $lists = $query->select('id', 'name')->get();

            // Check which lists the series is already present in
            $checkedLists = SerieList::whereIn('list_id', $query->select('id'))
                ->where('serie_id', $id)
                ->select('list_id')
                ->get();

            $checkedLists = $checkedLists->pluck('list_id')->toArray();
        } else {
            // If user is not authenticated, initialize empty lists
            $lists = [];
            $checkedLists = [];
        }

        // Retrieve the user's rating for the series
        $userRating = RatingSerie::where('user_id', auth()->id())
            ->where('serie_id', $apiData->id)
            ->value('rating');

        return view('series.details', compact('userRating'), ['serie' => $apiData, 'lists' => $lists, 'checkedLists' => $checkedLists, 'elementId' => $apiData->id, 'elementType' => 'serie']);
    }

    /**
     * Add or update a user's rating for a TV series.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $serieId Series ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRating(Request $request, $serieId)
    {
        // Validate the user's input for the rating
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        // Retrieve the authenticated user
        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Add or update the user's rating for the series
        $user->ratedSeries()->syncWithoutDetaching([$serieId => ['rating' => $request->input('rating')]]);

        return response()->json(['success' => 'Rating updated successfully.']);
    }

    /**
     * Get the average rating for a TV series.
     *
     * @param int $filmId Series ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAverageRating($filmId)
    {
        $serie = Serie::findOrFail($filmId);

        // Calculate the average rating for the series
        $averageRating = $serie->ratings->avg('rating');

        return response()->json(['averageRating' => $averageRating]);
    }
}
