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

    public function edit($productId){
        $product = Product::findOrFail($productId);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, $productId)
    {

        // $table->string('barcode')->unique();
        //     $table->string('product_name');
        //     $table->decimal('import_price', 8, 2);
        //     $table->decimal('retail_price', 8, 2);
        //     $table->string('category');
        $request->validate([
            'product_name' => 'string|required',
            'import_price' => 'numeric',
            'retail_price' => 'numeric',
            'category' => 'string|required'
        ]);
    
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