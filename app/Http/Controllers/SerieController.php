<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api;

class SerieController extends Controller
{
    public function showSerie($id)
    {
        $apiData = Api::getSerieDetails($id);

        return view('series.details', ['serie' => $apiData]);
    }
}
