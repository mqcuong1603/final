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
use Illuminate\Support\Facades\Mail;
use App\Mail\SalesActivationEmail; // Import the SalesActivationEmail class
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;

use Override;// Import the Auth class

class SalesmanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $salesman = Auth::guard('salesman')->user();

        return view('sales.sales_dashboard', ['customers' => $customers, 'salesman' => $salesman]);
    }

    public function createToken($length)
    {
        return bin2hex(random_bytes($length));
    }

    public function changePassword($token)
    {
        $salesman = Salesman::where('activation_token', $token)->first();
        if (!$salesman) {
            return redirect()->route('login')->with('error', 'Salesman not found');
        } elseif ($salesman->activation_token_expiry < now()) {
            return redirect()->route('login')->with('error', 'Activation token expired');
        } elseif ($salesman->isActivated) {
            return redirect()->route('login')->with('error', 'Salesman already activated');
        }

        return view('sales.changePassword', ['token' => $token]);
    }

    public function resendActivation($email)
    {
        $salesman = Salesman::where('email', $email)->first();

        if ($salesman) {
            $token = $salesman->createToken('Login Token', ['login'])->plainTextToken;
            $salesman->activation_token = $token;
            $salesman->activation_token_expiry = now()->addMinutes();
            $salesman->save();

            Mail::to($salesman->email)->send(new SalesActivationEmail($salesman, $token));
        }

        return redirect()->route('closeTab');
    }

    public function updatePassword(Request $request, $token)
    {
        $request->validate([
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        $salesman = Salesman::where('activation_token', $token)->first();

        if ($salesman) {
            $salesman->password = bcrypt($request->newPassword);
            $salesman->isActivated = true;
            $salesman->is_first_login = false;
            $salesman->activation_token = null;
            $salesman->save();

            return redirect()->route('passwordUpdated');
        }

        return redirect()->route('login')->with('error', 'Salesman not found');
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
            $totalProfit = 0;
            foreach ($request->products as $index => $barcode) {
                $product = Products::where('barcode', $barcode)->first();
                if ($product) {
                    $productPrice = $product->retail_price; // Corrected here
                    $totalPrice += $productPrice * $request->quantity[$index];
                    $totalProfit += ($product->retail_price - $product->import_price) * $request->quantity[$index];
                } else {
                    Log::error('Product not found with barcode: ' . $barcode);
                }
            }

            // Create a new order
            $order = new Order([
                'customer_id' => $customer->id,
                'order_date' => now(),
                'total_price' => $totalPrice,
                'total_profit' => $totalProfit,
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

            // Redirect to the receipt page
            return redirect()->route('sales.receipt', ['orderId' => $order->id]);
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

    public function receipt($orderId)
    {
        $order = Order::with(['customer', 'orderItems.product'])->findOrFail($orderId);

        return view('sales.receipt', ['order' => $order]);
    }

    public function searchByDate(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
    
        // Validate input dates
        $fromDate = Carbon::parse($fromDate);
        $toDate = Carbon::parse($toDate);
    
        if (!$fromDate || !$toDate) {
            // Handle invalid date input
            return redirect()->back()->withErrors(['Invalid date input']);
        }
    
        // Perform the search
        $orders = DB::table('orders')
            ->whereDate('order_date', '>=', $fromDate)
            ->whereDate('order_date', '<=', $toDate)
            ->get();
    
        // Return the results
        return view('sales.report', ['orders' => $orders]);
    }

    public function showOrderDetails($id)
    {
        $order = Order::with(['customer', 'orderItems.product'])->findOrFail($id);

        $products = $order->orderItems->map(function ($orderItem) {
            return [
                'name' => $orderItem->product->product_name,
                'quantity' => $orderItem->quantity,
            ];
        });

        return response()->json([
            'customerName' => $order->customer->fullName,
            'products' => $products,
            'totalPrice' => $order->total_price,
        ]);
    }

    public function customerHistory($customerId)
    {
        $customer = Customer::with('orders')->findOrFail($customerId);

        return view('sales.customerHistory', ['customer' => $customer]);
    }

    public function searchOrder(Request $request, $customerId)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        // Perform the search. This is just an example, replace with your actual search logic.
        $customer = Customer::with([
            'orders' => function ($query) use ($fromDate, $toDate) {
                $query->whereBetween('order_date', [$fromDate, $toDate]);
            },
        ])->findOrFail($customerId);

        return view('sales.customerHistory', ['customer' => $customer]);
    }

    public function salesInfo ($email)
    {
        $salesman = Salesman::where('email', $email)->first();
        return view('sales.salesInfo', ['salesman' => $salesman]);
    }

    public function editPassword(Request $request, $email)
    {
        $salesman = Salesman::where('email', $email)->first();
        $request->validate([
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        $salesman->password = bcrypt($request->newPassword);
        $salesman->save();

        return redirect()->route('sales.salesInfo', ['email' => $email])->with('success', 'Password updated successfully');
    }

    
}