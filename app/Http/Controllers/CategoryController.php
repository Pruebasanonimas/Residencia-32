<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    //Función para guardar la categoria
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories']);
        Category::create(['name' => $request->name]);
        return redirect()->back();
    }
}
