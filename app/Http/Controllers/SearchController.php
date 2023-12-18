<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api;
use App\Models\CardInfo;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * Perform a search based on user input and category.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        // Retrieve user input for the search query, category, and page number
        $query = $request->input('query');
        $category = $request->input('category');
        $page = $request->input('page') ?? 1;

        // Check if a search query is provided
        if ($query != null) {
            if ($category == 'films') {
                $res = Api::getFilmsList($query, $page);
            } elseif ($category == 'series') {
                $res = Api::getSeriesList($query, $page);
            } elseif ($category == 'users') {
                // Search for users and format the results for display
                $users = User::searchUsers($query);
                $res = [];

                // Create a CardInfo object for each user
                foreach ($users as $user) {
                    $cardInfo = new CardInfo();
                    $cardInfo->title = $user->username;
                    $cardInfo->image = $user->urlImage;
                    $cardInfo->route = route('profil', ['id' => $user->id]);

                    $res[] = $cardInfo;
                }
            } else {
                // If the category is not recognized, return to the search view
                return view('search');
            }

            // Return the search results to the view
            return view('search', ['results' => $res]);
        }

        // If no search query is provided, return to the search view
        return view('search');
    }
}
