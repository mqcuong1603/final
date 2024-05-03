<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Import the missing class
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Mail; // Import the Mail facade
use App\Mail\SalesActivationEmail; // Import the SalesActivationEmail Mailable
use App\Models\Salesman; // Import the Salesman model
use Illuminate\Support\Facades\Log;

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
    public function lock($email)
    {   
        $salesman = Salesman::findOrFail($email);
        $salesman->isLocked = true;
        $salesman->save();
        return redirect()->route('admin.admin_dashboard');

    }

    /**
     * Unlocks a user account.
     *
     * @param int $email The email of the user to unlock.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlock($email)
    {
        $salesman = Salesman::findOrFail($email);
        $salesman->isLocked = false;
        $salesman->save();
        return redirect()->route('admin.admin_dashboard');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request object.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSaleAccount(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            // Add more validation rules as needed
        ]);

        // Create the user
        User::create($validatedData);

        return response()->json(['message' => 'User created successfully'], 201);
    }

    /**
     * Display the specified user.
     *
     * @param  int  $email The email of the user to display.
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $email)
    {
        $user = User::findOrFail($email);
        return view('admin.show', ['user' => $user]);
    }

    /**
     * Send activation email to a salesman.
     *
     * @param  \App\Models\Salesman  $salesman The salesman to send the activation email to.
     * @return void
     */
    public function sendActivationEmail(Salesman $salesman)
    {
        Mail::to($salesman->email)->send(new SalesActivationEmail);
    }

    /**
     * Activate a salesman.
     *
     * @param  \App\Models\Salesman  $salesman The salesman to activate.
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
     * @param  \App\Models\Salesman  $salesman The salesman to deactivate.
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
     * @param  \App\Models\Salesman  $salesman The salesman to delete.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($email)
    {
            $salesman = Salesman::findOrFail($email);
            $salesman->delete();

            return redirect()->route('admin.index');
        }

        public function changePassword(Request $request)
        {
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);

            $user = User::where('email', $validatedData['email'])->first();
            $user->password = bcrypt($validatedData['password']);
            $user->save();

            return response()->json(['message' => 'Password changed successfully'], 200);
        }

        /**
         * Update a user's information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $oldEmail
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $oldEmail)
{   
    
    $validatedData = $request->validate([
        'fullName' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'status' => 'required|numeric|min:0|max:1'
    ]);

    $salesman = Salesman::where('email', $oldEmail)->first();
    
    if (!$salesman) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $salesman->fullName = $validatedData['fullName'];
    $salesman->email = $validatedData['email'];
    $salesman->isActivated = $validatedData['status'];
    $salesman->save();

    return redirect()->route('admin.admin_dashboard');
}

    public function searchSalesman(Request $request)
    {
        $validatedData = $request->validate([
            'search' => 'required|string|max:255'
        ]);

        $salesmen = Salesman::where('fullName', 'like', '%' . $validatedData['search'] . '%')->get();

        return view('admin.admin_dashboard', ['salesmen' => $salesmen]);
    }

}
// Remove the extra closing brace '}' from the selected code block
// to fix the syntax error and unexpected '}' errors.
// The corrected code block is as follows:
