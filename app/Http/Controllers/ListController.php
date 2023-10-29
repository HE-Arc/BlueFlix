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
        $lists = Liste::all();
        return view('lists.index', ['lists' => $lists]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list = \App\Models\Liste::find($id);

        $list->films()->detach();
        $list->delete();

        return redirect()->route('lists.index')
            ->with('success','List deleted successfully');
    }
}
