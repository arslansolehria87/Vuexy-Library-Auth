<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'subcategory'])->latest()->paginate(10);
        $categories = Category::where('status', 1)->get();
        // Yeh JS dropdown ke liye saari subcategories bhej rahe hain
        $subcategories = SubCategory::where('status', 1)->get(); 

        return view('products.index', compact('products', 'categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        Product::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sku' => 'PROD-' . strtoupper(Str::random(6)), // Automatic SKU
            'price' => $request->price,
            'cost' => $request->cost,
            'quantity' => $request->quantity,
            'image' => $imageName,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imageName = $product->image;
        if ($request->hasFile('image')) {
            // Purani image delete karein
            if(File::exists(public_path('uploads/products/'.$product->image))){
                File::delete(public_path('uploads/products/'.$product->image));
            }
            // Nayi save karein
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        // Stock Logic (Add or Remove)
        $newQuantity = $product->quantity;
        if($request->stock_action == 'add' && $request->adjust_quantity > 0){
            $newQuantity += $request->adjust_quantity;
        } elseif ($request->stock_action == 'remove' && $request->adjust_quantity > 0){
            $newQuantity -= $request->adjust_quantity;
        }

        $product->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'cost' => $request->cost,
            'quantity' => $newQuantity,
            'image' => $imageName,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Image Delete karein DB se uranay se pehle
        if(File::exists(public_path('uploads/products/'.$product->image))){
            File::delete(public_path('uploads/products/'.$product->image));
        }
        $product->delete();
        
        return redirect()->route('products.index')->with('delete_success', 'Product deleted successfully.');
    }
}