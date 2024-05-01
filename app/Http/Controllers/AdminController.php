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

    public function isAdmin(Request $request)
    {
        $user = User::findOrFail($request->email);
        $user->isAdmin = true;
        
        if ($user->password = bcrypt($request->password)) {
            $user->save();
            return redirect()->route('admin.admin_dashboard');
        }
    }

    /**
     * Locks a user account.
     *
     * @param int $id The ID of the user to lock.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lock(int $id)
    {
        $user = User::findOrFail($id);
        $user->isLocked = true;
        $user->save();

        return redirect()->route('admin.index');
    }

    /**
     * Unlocks a user account.
     *
     * @param int $id The ID of the user to unlock.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlock(int $id)
    {
        $user = User::findOrFail($id);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
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
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $user = User::findOrFail($id);
        return view('admin.show', ['user' => $user]);
    }

    public function sendActivationEmail(Salesman $salesman)
    {
        Mail::to($salesman->email)->send(new SalesActivationEmail);
    }
}
