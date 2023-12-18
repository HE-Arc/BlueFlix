<?php

namespace App\Http\Controllers;

use App\Models\Liste;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = Liste::where('user_id', auth()->user()->id)->get();

        //$lists = Liste::all();
        return view('lists.index', ['lists' => $lists]);
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

        if ($request->hasFile('urlImage')) {
            $imageName = time().'.'.$request->user()->id.'.'.$request->urlImage->extension();
            $request->urlImage->move(public_path('images'), $imageName);
        }
        else {
            $imageName = 'default/list.png';
        }

        // -------------------------------
        // Code by Moak on StackOverflow (https://stackoverflow.com/a/51970195)
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['urlImage'] = $imageName;
        Liste::create($data);
        // -------------------------------

        return redirect()->route('profil', ['id' => auth()->id()])
            ->with('success', 'List created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list = \App\Models\Liste::findOrFail($id);
        return view('lists.show', ['list' => $list]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list = \App\Models\Liste::findOrFail($id);

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
            'nom' => 'required|min:5|max:30',
            'urlImage' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $list = \App\Models\Liste::findOrFail($id);

        if($list->user_id != $request->user()->id) {
            return redirect()->route('profil', ['id' => auth()->id()])
                ->with('error', 'You don\'t have access to this ressource.');
        }

        $list->nom = $request->get('nom');

        if ($request->hasFile('urlImage')) {
            unlink(public_path('images/'.$list->urlImage));
            $imageName = time().'.'.$request->user()->id.'.'.$request->urlImage->extension();
            $request->urlImage->move(public_path('images'), $imageName);
            $list->urlImage = $imageName;
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

        $list = \App\Models\Liste::findOrFail($id);

        if($list->user_id != $request->user()->id) {
            return response()->json([
                'error' => 'You don\'t have access to this ressource.'
            ]);
        }

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
        $list = \App\Models\Liste::find($id);

        if($list->user_id != auth()->id()) {
            return redirect()->route('profil', ['id' => auth()->id()])
                ->with('error', 'You don\'t have access to this ressource.');
        }

        if($list->deleteable == false) {
            return redirect()->route('profil', ['id' => auth()->id()])
                ->with('error', 'You can\'t delete this list.');
        }

        unlink(public_path('images/'.$list->urlImage));

        $list->films()->detach();
        $list->series()->detach();
        $list->delete();

        return redirect()->route('profil', ['id' => auth()->id()])
            ->with('success', 'List deleted successfully.');
    }

    public function destroyMovie(string $id, string $movieId)
    {
        $list = \App\Models\Liste::find($id);
        $list->films()->detach($movieId);

        return redirect()->route('lists.show', $id)
            ->with('success','Movie deleted successfully');
    }

    public function destroySeries(string $id, string $seriesId)
    {
        $list = \App\Models\Liste::find($id);
        $list->series()->detach($seriesId);

        return redirect()->route('lists.show', $id)
            ->with('success','Series deleted successfully');
    }
}
