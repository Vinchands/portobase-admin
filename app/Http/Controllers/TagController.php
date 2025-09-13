<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Auth::user()->tags;
        return view('auth.tags', ['tags' => $tags]);
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
        $validated = $request->validate([
            'name' => 'required|string',
        ]);
        
        Auth::user()->tags()->create($validated);
        
        return to_route('tags.index')->with('success', 'New tag added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $request->validate([
            'name' => 'required|string',
        ]);
        
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->save();
        
        return to_route('tags.index')->with('success', 'Tag updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        
        return to_route('tags.index')->with('success', 'Tag updated.');
    }
}
