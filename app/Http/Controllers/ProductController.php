<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
         $products = Product::all();
        // return response()->json($products);
        return view('products.index', compact('products'));

    }
    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('products.index');
    }
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('products.index');
    }
    public function destroy(Product $product)
    {
        if ($product->orders()->count() > 0) {
            return redirect()->route('products.index')->withErrors('Product cannot be deleted because it has been purchased');
        }
        $product->delete();
        return redirect()->route('products.index');
    }
}