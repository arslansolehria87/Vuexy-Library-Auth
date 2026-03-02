<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    // List aur Dropdown ka data bhejna
    public function index()
    {
        // Sub Categories table ke liye (Sath Main Category ka naam bhi aayega)
        $subcategories = SubCategory::with('category')->latest()->paginate(10);
        
        // Form ke Dropdown ke liye sirf Active Categories nikalna
        $categories = Category::where('status', 1)->get(); 

        return view('subcategories.index', compact('subcategories', 'categories'));
    }

    // Nayi Sub Category Save karna
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:sub_categories,name'
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('subcategories.index')->with('success', 'Sub Category added successfully.');
    }

    // Sub Category Update (Edit) karna
    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:sub_categories,name,' . $subcategory->id
        ]);

        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('subcategories.index')->with('success', 'Sub Category updated successfully.');
    }

    // Sub Category Delete karna
    public function destroy(SubCategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('delete_success', 'Sub Category deleted successfully.');
    }
}