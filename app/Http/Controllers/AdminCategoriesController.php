<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.edit-add');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:255']);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoría creada correctamente');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit-add', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate(['name' => 'required|max:255']);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoría actualizada correctamente');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        // No borrar si tiene peticiones asociadas
        if ($category->petitions()->count() > 0) {
            return redirect()->back()
                ->with('error', 'No puedes borrar esta categoría porque tiene peticiones asociadas.');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Categoría eliminada correctamente');
    }
}
