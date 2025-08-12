<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Exibe o formulário de criação de categoria (opcional)
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Armazena uma nova categoria no banco de dados
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('movies.index')->with('success', 'Categoria criada com sucesso!');
    }
}
