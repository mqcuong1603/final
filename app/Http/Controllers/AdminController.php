<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use App\Mail\Mailer;
use App\Mail\SalesActivationEmail;
use App\Models\Salesman;
use Illuminate\Support\Facades\Mail;

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
        return view('admin.index', ['users' => $users]);
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

    public function sendActivationEmail(Salesman $salesperson)
    {
        Mail::to($salesperson->email)->send(new SalesActivationEmail);
    }
}
