<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Step 6: Category List show karwana
    public function index()
    {
        $categories = Category::latest()->paginate(10); // 10 entries per page
        return view('categories.index', compact('categories'));
    }

    // Step 7: Nayi Category Save karna
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Automatically naam se slug banega
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    // Step 8: Category Update (Edit) karna
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Step 9 & 10: Category Delete karna
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('delete_success', 'Category deleted successfully.');
    }
}