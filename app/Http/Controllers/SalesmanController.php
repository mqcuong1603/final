<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Products;

class SalesmanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('sales.sales_dashboard', ['customers' => $customers]);
    }

    public function searchCustomer(Request $request)
    {
        $validatedData = $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $customers = Customer::where('fullName', 'like', '%' . $validatedData['search'] . '%')
            ->orWhere('email', 'like', '%' . $validatedData['search'] . '%')
            ->orWhere('phone', 'like', '%' . $validatedData['search'] . '%')
            ->orWhere('address', 'like', '%' . $validatedData['search'] . '%')
            ->get();

        return view('sales.sales_dashboard', ['customers' => $customers]);
    }

    public function transaction()
    {
        $products = Products::all();
        return view('sales.sales_transaction', ['products' => $products]);
    }

    public function createOrder(Request $request, Customer $customer)
    {
        $order = new Order($request->all());
        $customer->orders()->save($order);

        return redirect()->back();
    }

    
}
