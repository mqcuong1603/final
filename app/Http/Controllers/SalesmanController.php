<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;
use App\Models\Salesman;

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

    public function changePassword($email)
    {
        $salesman = Salesman::where('email', $email)->first();
        return view('sales.changePassword', ['salesman' => $salesman]);
    }

    public function updatePassword(Request $request, $email)
    {
        $request->validate([
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        $salesman = Salesman::where('email', $email)->first();

        if ($salesman) {
            $salesman->password = bcrypt($request->newPassword);
            $salesman->is_first_login = false;
            $salesman->save();

            return redirect()->route('sales.sales_dashboard')->with('success', 'Password updated successfully');
        }

        return redirect()->route('sales.sales_dashboard')->with('error', 'Salesman not found');
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

    public function report()
    {
        $orders = Order::all();
        return view('sales.report', ['orders' => $orders]);
    }

    public function createOrder(Request $request, Customer $customer)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Calculate the total price
            $totalPrice = 0;
            foreach ($request->products as $index => $barcode) {
                $product = Products::where('barcode', $barcode)->first();
                if ($product) {
                    $productPrice = $product->retail_price; // Corrected here
                    $totalPrice += $productPrice * $request->quantity[$index];
                } else {
                    Log::error('Product not found with barcode: ' . $barcode);
                }
            }

            // Create a new order
            $order = new Order([
                'customer_id' => $customer->id,
                'order_date' => now(),
                'total_price' => $totalPrice,
            ]);
            $customer->orders()->save($order);

            // Loop through the products and create order items
            foreach ($request->products as $index => $barcode) {
                $product = Products::where('barcode', $barcode)->first();
                if ($product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $request->quantity[$index],
                    ]);
                } else {
                    Log::error('Product not found with barcode: ' . $barcode);
                }
            }

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Order created successfully');
        } catch (\Exception $e) {
            // An error occurred; cancel the transaction...
            DB::rollback();

            Log::error('Failed to create order: ' . $e->getMessage());

            // and return to the previous form with an error message
            return redirect()->back()->with('error', 'Failed to create order');
        }
    }

    public function checkCustomer(Request $request)
    {
        $email = $request->input('email');
        $phone = $request->input('phone');

        $customer = Customer::where('email', $email)->orWhere('phone', $phone)->first();

        if ($customer) {
            Log::info('Customer found with email: ' . $email . ' and phone: ' . $phone);

            // If a customer is found, create an order and order items
            return $this->createOrder($request, $customer);
        } else {
            Log::info('No customer found with email: ' . $email . ' and phone: ' . $phone . '. Creating new customer.');

            // If no customer is found, create a new customer
            $customer = new Customer([
                'email' => $email,
                'phone' => $phone,
            ]);
            $customer->save();

            // Then create an order and order items for the new customer
            return $this->createOrder($request, $customer);
        }
    }

    public function searchByDate(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        

        // Perform the search. This is just an example, replace with your actual search logic.
        $orders = DB::table('orders')
            ->whereBetween('order_date', [$fromDate, $toDate])
            ->get();

        // Return the results. This is just an example, replace with your actual return logic.
        return view('sales.report', ['orders' => $orders]);
    }
}
