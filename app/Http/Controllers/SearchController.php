<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $page = $request->input('page') ?? 1;

        if ($query != null)
        {
            if ($category == 'films')
                $apiData = Api::getFilmsList($query, $page);
            else if ($category == 'series')
                $apiData = Api::getSeriesList($query, $page);
            else
                return view('search');

            return view('search', ['results' => $apiData]);
        }

        return view('search');
    }
}
