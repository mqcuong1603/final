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
    public function update(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $product->update($request->all());
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();
    
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}