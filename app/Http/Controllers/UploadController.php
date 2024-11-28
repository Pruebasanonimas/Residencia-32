<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    // Mostrar la vista de documentos
    public function index(Request $request)
    {
        $category_id = $request->category_id;
        $categories = Category::all();

        $uploads = $category_id
            ? Upload::where('category_id', $category_id)->latest()->get()
            : Upload::latest()->get();

        return view('verarchivos', compact('uploads', 'categories'));
    }

    // Función para crear una categoria
    public function create()
    {
        $categories = Category::all();
        return view('subirarchivos', compact('categories'));
    }

    // Función para guardar un documento
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,rar,zip,exe',
            'author' => 'required',
        ]);

        $filePath = $request->file('file')->store('uploads', 'public');

        Upload::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'file_path' => $filePath,
            'author' => $request->author,
        ]);

        return response()->json(['message' => 'Archivo subido con éxito'], 200); 
    }
    public function edit(Request $request)
    {
        $category_id = $request->category_id;
        $categories = Category::all();

        $uploads = $category_id
            ? Upload::where('category_id', $category_id)->latest()->get()
            : Upload::latest()->get();

        return view('editararchivos', compact('uploads', 'categories'));
    }

    // Función para eliminar un documento
    public function destroy(Upload $upload)
    {
        Storage::disk('public')->delete($upload->file_path);
        $upload->delete();

        return redirect()->route('edit');
    }
}
