<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Movie;

class MovieController extends Controller
{
    
    public function index() {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function create() {
        $categories = Category::all();
        return view('movies.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'synopsis' => 'required',
            'year' => 'required|digits:4|integer',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'required|image|mimes:jpg,jpeg,png',
            'trailer_link' => 'nullable|url',
        ]);

        $imagePath = $request->file('cover_image')->store('covers', 'public');

        Movie::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'year' => $request->year,
            'category_id' => $request->category_id,
            'cover_image' => $imagePath,
            'trailer_link' => $request->trailer_link,
        ]);

        return redirect()->route('movies.index')->with('success', 'Filme cadastrado com sucesso!');
    }
}
