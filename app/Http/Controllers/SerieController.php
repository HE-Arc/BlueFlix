<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Api;
use App\Models\Liste;
use App\Models\SerieListe;
use App\Models\RatingSerie;
use App\Models\Serie;

class SerieController extends Controller
{
    public function showSerie($id)
    {
        $apiData = Api::getSerieDetails($id);
        if(Auth::check()) {
            $query = Liste::where('user_id', auth()->user()->id);
            $lists = $query->select('id', 'nom')->get();
            $checkedLists = SerieListe::whereIn('liste_id', $query->select('id'))->where('serie_id', $id)->select('liste_id')->get();
            $checkedLists = $checkedLists->pluck('liste_id')->toArray();
        } else {
            $lists = [];
            $checkedLists = [];
        }

        $userRating = RatingSerie::where('user_id', auth()->id())
                        ->where('serie_id', $apiData->id)
                        ->value('rating');

        return view('series.details', compact('userRating'), ['serie' => $apiData, 'lists' => $lists, 'checkedLists' => $checkedLists, 'elementId' => $apiData->id, 'elementType' => 'serie']);
    }

    public function addRating(Request $request, $serieId)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->ratedSeries()->syncWithoutDetaching([$serieId => ['rating' => $request->input('rating')]]);

        return response()->json(['success' => 'Rating updated successfully.']);
    }

    public function getAverageRating($filmId)
    {
        $serie = Serie::findOrFail($filmId);

        // Calculez la nouvelle moyenne des évaluations pour le film
        $averageRating = $serie->ratings->avg('rating');

        return response()->json(['averageRating' => $averageRating]);
    }
}
