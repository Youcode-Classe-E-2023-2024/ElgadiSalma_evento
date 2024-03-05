<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class categoryController extends Controller
{
    public function categoryView()
    {
        $categories = Category::all();
        return view('Categories.category' , compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect('/category');
    }

    public function editCategory(Request $request)
    {
        $validated = request()->validate([
            'name' => 'required',
        ]);

        $categoryId = $request->input('categoryId');

        $category = Category::findOrFail($categoryId);
        $category->update($validated);

        return redirect('/category');
    }

    public function deleteCategory(Request $request)
    {
        $categoryId = $request->input('categoryId');

        $category = Category::findOrFail($categoryId);
        $category->delete();

        return redirect('/category');
    }

}
