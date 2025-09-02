<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    private $currentUser;
    
    public function __construct()
    {
        $this->currentUser = auth()->user();
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('user_id', $this->currentUser->id)->get();
        return view('auth.categories', ['categories' => $categories]);
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
        $request->validate([
          'name' => 'required|string'
        ]);
        
        Category::create([
          'user_id' => $this->currentUser->id,
          'name' => $request->name,
        ]);
        
        return to_route('categories.index')->with('success', 'New category added.');
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
            'name' => 'required|string'
        ]);
        
        $category = Category::where('id', $id)->where('user_id', $currentUser->id);
        $category->name = $request->name;
        $category->save();
        
        return to_route('categories.index')->with('success', 'Category updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('id', $id)->where('user_id', $this->currentUser->id);
        $category->delete();
        
        return to_route('categories.index')->with('success', 'Category deleted.');
    }
}
