<?php

namespace App\Http\Controllers;

use App\Models\ListClass;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('profil', ['id' => auth()->id()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:5|max:30',
            'urlImage' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        //if the user has uploaded an image, save it in the public/images folder
        if ($request->hasFile('urlImage')) {
            $imageName = time().'.'.$request->user()->id.'.'.$request->urlImage->extension();
            $request->urlImage->move(public_path('images'), $imageName);
        }
        else { //else, use the default image
            $imageName = 'default/list.png';
        }

        // -------------------------------
        // Code by Moak on StackOverflow (https://stackoverflow.com/a/51970195)
        $data['name'] = $request->input('nom');
        $data['user_id'] = $request->user()->id;
        $data['image_url'] = $imageName;
        ListClass::create($data);
        // -------------------------------

        return redirect()->route('profil', ['id' => auth()->id()])
            ->with('success', 'List created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list = ListClass::findOrFail($id);
        return view('lists.show', ['list' => $list]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list = ListClass::findOrFail($id);

        //if the user is not the owner of the list, redirect him to his profile page
        if($list->user_id != auth()->id()) {
            return redirect()->route('profil', ['id' => auth()->id()])
                ->with('error', 'You don\'t have access to this ressource.');
        }

        return view('lists.edit', ['list' => $list]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|min:5',
            'urlImage' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $list = ListClass::findOrFail($id);

        //if the user is not the owner of the list, redirect him to his profile page
        if($list->user_id != $request->user()->id) {
            return redirect()->route('profil', ['id' => auth()->id()])
                ->with('error', 'You don\'t have access to this ressource.');
        }

        $list->name = $request->get('nom');

        //if the user has uploaded an image, update it in the public/images folder
        if ($request->hasFile('urlImage')) {
            unlink(public_path('images/'.$list->image_url));
            $imageName = time().'.'.$request->user()->id.'.'.$request->urlImage->extension();
            $request->urlImage->move(public_path('images'), $imageName);
            $list->image_url = $imageName;
        }

        $list->save();

        return redirect()->route('profil', ['id' => auth()->id()])
            ->with('success', 'List updated successfully.');
    }

    public function ajaxUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'listId' => 'required|numeric',
            'isChecked' => 'required|boolean',
            'elementData' => 'required|numeric',
            'elementType' => 'required|in:film,serie',
        ]);

        $id = $validatedData['listId'];
        $isChecked = $validatedData['isChecked'];
        $elementId = $validatedData['elementData'];
        $elementType = $validatedData['elementType'];

        $list = ListClass::findOrFail($id);

        //if the user is not the owner of the list, return an error
        if($list->user_id != $request->user()->id) {
            return response()->json([
                'error' => 'You don\'t have access to this ressource.'
            ]);
        }

        //based on the element type and the isChecked value, attach or detach the element to the list
        if($elementType == 'film') {
            if($isChecked) {
                $list->films()->attach($elementId);
            } else {
                $list->films()->detach($elementId);
            }
        } else if($elementType == 'serie') {
            if($isChecked) {
                $list->series()->attach($elementId);
            } else {
                $list->series()->detach($elementId);
            }
        } else {
            return response()->json([
                'error' => 'Invalid element type.'
            ]);
        }

        return response()->json([
            'success' => 'List updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list = ListClass::findOrFail($id);

        //if the user is not the owner of the list, redirect him to his profile page
        if($list->user_id != auth()->id()) {
            return redirect()->route('profil', ['id' => auth()->id()])
                ->with('error', 'You don\'t have access to this ressource.');
        }

        //if the list is not deleteable, redirect the user to his profile page
        if($list->deleteable == false) {
            return redirect()->route('profil', ['id' => auth()->id()])
                ->with('error', 'You can\'t delete this list.');
        }

        //delete the image from the public/images folder
        unlink(public_path('images/'.$list->image_url));

        //detach all the elements from the list and delete the list
        $list->films()->detach();
        $list->series()->detach();
        $list->delete();

        return redirect()->route('profil', ['id' => auth()->id()])
            ->with('success', 'List deleted successfully.');
    }

    public function destroyMovie(string $id, string $movieId)
    {
        $list = ListClass::findOrFail($id);
        $list->films()->detach($movieId);

        return redirect()->route('lists.show', $id)
            ->with('success','Movie deleted successfully');
    }

    public function destroySeries(string $id, string $seriesId)
    {
        $list = ListClass::findOrFail($id);
        $list->series()->detach($seriesId);

        return redirect()->route('lists.show', $id)
            ->with('success','Series deleted successfully');
    }
}
