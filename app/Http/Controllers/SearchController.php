<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api;
use App\Models\CardInfo;
use App\Models\User;

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
                $res = Api::getFilmsList($query, $page);
            else if ($category == 'series')
                $res = Api::getSeriesList($query, $page);
            else if ($category == 'users')
            {
                $users = User::searchUsers($query);

                $res = [];

                foreach ($users as $user)
                {
                    $cardInfo = new CardInfo();
                    $cardInfo->title = $user->username;
                    $cardInfo->image = $user->urlImage;
                    $cardInfo->route = route('profil', ['id' => $user->id]);

                    $res[] = $cardInfo;
                }
            }
            else
                return view('search');

            return view('search', ['results' => $res]);
        }

        return view('search');
    }
}
