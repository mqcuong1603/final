<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SalesActivationEmail;
use App\Models\Salesman;
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
        // Validate incoming request data
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:salesmen|max:255', // Ensure the email is unique in the 'salesmen' table
            // Add more validation rules as needed
        ]);

        // Extract username from email
        $username = strstr($validatedData['email'], '@', true);

        // Create the salesman
        Salesman::create([
            'fullName' => $validatedData['fullName'],
            'email' => $validatedData['email'],
            'username' => $username,
            'password' => bcrypt($username),
            'is_first_login' => true,
        ]);

        // Flash a success message to the session
        session()->flash('success', 'Salesman created successfully. Username and Password: ' . $username);

        return redirect()->route('admin.admin_dashboard');
    }

    /**
     * Display the specified user.
     *
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
    public function sendActivationEmail(Salesman $salesman)
    {
        Mail::to($salesman->email)->send(new SalesActivationEmail());
        Mail::to($salesman->email)->send(new SalesActivationEmail());
    }

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $oldEmail)
    {
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|numeric|min:0|max:1',
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
}
