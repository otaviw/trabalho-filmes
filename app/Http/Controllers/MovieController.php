<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::with('category');
        
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
        
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        $movies = $query->orderBy('year', 'desc')->get();
        $categories = Category::all();
        
        $years = Movie::distinct()->pluck('year')->sort()->reverse();
        
        // Filme aleatório
        $randomMovie = $movies->count() > 0 ? $movies->random() : null;
        
        return view('movies.index', compact('movies', 'categories', 'years', 'randomMovie'));
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('movies.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
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

        return redirect()->route('home')->with('success', 'Filme cadastrado com sucesso!');
    }

    public function edit(Movie $movie)
    {
        $categories = Category::all();
        return view('movies.edit', compact('movie', 'categories'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'trailer_link' => 'nullable|url',
        ]);

        $data = $request->only(['title', 'synopsis', 'year', 'category_id', 'trailer_link']);

        if ($request->hasFile('cover_image')) {
            if ($movie->cover_image && Storage::disk('public')->exists($movie->cover_image)) {
                Storage::disk('public')->delete($movie->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $movie->update($data);

        return redirect()->route('home')->with('success', 'Filme atualizado com sucesso!');
    }

    public function destroy(Movie $movie)
    {     
        if ($movie->cover_image && Storage::disk('public')->exists($movie->cover_image)) {
            Storage::disk('public')->delete($movie->cover_image);
        }
        
        $movie->delete();
        return redirect()->route('home')->with('success', 'Filme excluído com sucesso!');
    }
}
