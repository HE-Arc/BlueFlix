<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Api;
use App\Models\Liste;
use App\Models\SerieListe;

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
        return view('series.details', ['serie' => $apiData, 'lists' => $lists, 'checkedLists' => $checkedLists, 'elementId' => $apiData->id, 'elementType' => 'serie']);
    }
}
