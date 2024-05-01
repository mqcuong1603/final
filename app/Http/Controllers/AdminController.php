<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Import the missing class
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Mail; // Import the Mail facade
use App\Mail\SalesActivationEmail; // Import the SalesActivationEmail Mailable
use App\Models\Salesman; // Import the Salesman model

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
        
        return view('admin.admin_dashboard', ['users' => $users]);
    }

    /**
     * Locks a user account.
     *
     * @param int $email The email of the user to lock.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lock(int $email)
    {
        $user = User::findOrFail($email);
        $user->isLocked = true;
        $user->save();

        return redirect()->route('admin.index');
    }

    /**
     * Unlocks a user account.
     *
     * @param int $email The email of the user to unlock.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlock(int $email)
    {
        $user = User::findOrFail($email);
        $user->isLocked = false;
        $user->save();

        return redirect()->route('admin.index');
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
    public function delete(Salesman $salesman)
    {
        $salesman->delete();

        return redirect()->route('admin.index');
    }

    
}
