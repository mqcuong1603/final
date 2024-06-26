<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SalesActivationEmail;
use App\Models\Salesman;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import the Carbon class from the correct namespace
class AdminController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::all();
        $salesmen = Salesman::all();

        return view('admin.admin_dashboard', ['users' => $users, 'salesmen' => $salesmen]);
    }

    /**
     * Locks a user account.
     *
     * @param int $email The email of the user to lock.
     * @return \Illuminate\Http\RedirectResponse
     */

    public function changeLock(Request $request, $email)
    {
        $email = urldecode($email);
        $salesman = Salesman::where('email', $email)->first();

        if ($salesman) {
            $salesman->isLocked = !$salesman->isLocked;
            $salesman->save();
            return redirect()->back()->with('success', 'Salesman lock status changed successfully.');
        }

        return redirect()->back()->with('error', 'Salesman not found.');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Contracts\View\View
     */

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request object.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSaleAccount(Request $request)
    {
        $validatedData = $request->validate([
            'fullName' => 'required|max:255',
            'email' => 'required|email|unique:salesmen|max:255',
        ]);

        $username = strstr($validatedData['email'], '@', true);

        $salesman = Salesman::create([
            'fullName' => $validatedData['fullName'],
            'email' => $validatedData['email'],
            'username' => $username,
            'password' => bcrypt($username),
            'is_first_login' => true,
        ]);

        $token = $salesman->createToken('Login Token', ['login'])->plainTextToken;
        $salesman->activation_token = $token;
        $salesman->activation_token_expiry = Carbon::now()->addMinute();
        $salesman->save();

        Mail::to($salesman->email)->send(new SalesActivationEmail($salesman, $token));

        session()->flash('success', 'Salesman created successfully. An email has been sent to ' . $salesman->email);

        return redirect()->route('admin.admin_dashboard');
    }
    /**
     * Display the specified user.
     *
     * @param int $email The email of the user to display.
     * @param int $email The email of the user to display.
     * @return \Illuminate\Contracts\View\View
     */
    public function show($email)
    {
        $user = User::findOrFail($email);
        return view('admin.show', ['user' => $user]);
    }

    /**
     * Send activation email to a salesman.
     *
     * @param \App\Models\Salesman $salesman
     * @return void
     */

    /**
     * Activate a salesman.
     *
     * @param \App\Models\Salesman $salesman
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateSalesman(Salesman $salesman)
    {
        $salesman->isActivated = true;
        $salesman->save();

        return redirect()->route('admin.index');
    }

    /**
     * Deactivate a salesman.
     *
     * @param \App\Models\Salesman $salesman
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivateSalesman(Salesman $salesman)
    {
        $salesman->isActivated = false;
        $salesman->save();

        return redirect()->route('admin.index');
    }

    /**
     * Delete a salesman.
     *
     * @param \App\Models\Salesman $salesman
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($email)
    {
        $salesman = Salesman::where('email', $email)->firstOrFail();
        $salesman->delete();
        return redirect()->route('admin.admin_dashboard');
    }

    public function changePassword($user_email)
    {
        $user = User::where('email', $user_email)->first();
        return view('admin.changePass', ['user' => $user]);
    }

    public function updatePassword(Request $request, $email)
    {
        $validatedData = $request->validate([
            'currentPassword' => 'required|string|min:5',
            'newPassword' => 'required|string|min:5',
            'confirmPassword' => 'required|string|min:5',
        ]);

        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        } elseif ($validatedData['newPassword'] != $validatedData['confirmPassword']) {
            return response()->json(['error' => 'Passwords do not match'], 400);
        } elseif (!password_verify($validatedData['currentPassword'], $user->password)) {
            return response()->json(['error' => 'Incorrect password'], 400);
        } else {
            $user->password = bcrypt($validatedData['newPassword']);
            $user->save();
            return redirect()->route('admin.admin_dashboard');
        }
    }

    /**
     * Update a user's information
     *
     * @param \Illuminate\Http\Request $request
     * @param string $oldEmail
     * @param \Illuminate\Http\Request $request
     * @param string $oldEmail
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Request $request, $oldEmail)
    {
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|numeric|min:0|max:1',
            'image' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $salesman = Salesman::where('email', $oldEmail)->first();

        if (!$salesman) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $salesman->fullName = $validatedData['fullName'];
        $salesman->email = $validatedData['email'];
        $salesman->isActivated = $validatedData['status'];
        $salesman->phone = $validatedData['phone'];
        $salesman->address = $validatedData['address'];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('salesmen_images', 'public');
            $salesman->profilePicture = $path;
        }

        $salesman->save();

        return redirect()->route('admin.admin_dashboard');
    }
    public function searchSalesman(Request $request)
    {
        $validatedData = $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $salesmen = Salesman::where('fullName', 'like', '%' . $validatedData['search'] . '%')
            ->orWhere('email', 'like', '%' . $validatedData['search'] . '%')
            ->get();

        return view('admin.admin_dashboard', ['salesmen' => $salesmen, 'search' => $validatedData['search']]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function report()
    {
        $orders = Order::all();

        foreach ($orders as $order) {
        }
        return view('admin.admin_report', ['orders' => $orders]);
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
            'totalProfit' => $order->total_profit,
        ]);
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
        return view('admin.admin_report', ['orders' => $orders]);
    }
}