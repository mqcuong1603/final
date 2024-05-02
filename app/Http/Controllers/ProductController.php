<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function adminIndex()
    {
        // Ensure the user is an admin
        if (!Auth::user() || !Auth::user()->isAdmin) {
            abort(403, 'Unauthorized action.');
        }

        $products = Products::all(); // Retrieve all products from the database

        return view('admin.products', ['products' => $products]);
    }

    public function salesIndex()
    {
        // Ensure the user is a salesperson
        if (!Auth::user() || !Auth::user()->isSales) {
            abort(403, 'Unauthorized action.');
        }

        $products = Products::all(); // Retrieve all products from the database

        return view('sales.products', ['products' => $products]);
    }
    public function index()
    {
        $products = Products::all();
        // return response()->json($products);
        return view('products.index', compact('products'));
    }
    /* public function store(Request $request)
    {
        Products::create($request->all());
        return redirect()->route('products.index');
    } */

    public function store(Request $request)
    {
    $request->validate([
        'product_id' => 'numeric|required',
        'product_barcode' => 'numeric',
        'product_name' => 'string|required',
        'import_price' => 'numeric',
        'retail_price' => 'numeric',
        'category' => 'string|required'
    ]);

    Products::create($request->all());

    return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function create()
    {
        $product = new Products();
        return view('products.create', compact('product'));
    }

    public function edit($productId)
    {
        $product = Products::findOrFail($productId);
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

        $product = Products::findOrFail($productId);
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }
    public function destroy($productId)
    {
        $product = Products::findOrFail($productId);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
