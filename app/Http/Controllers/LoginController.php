<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if ($request->input('formType') === 'admin') {
                return redirect()->route('admin.admin_dashboard');
            } else {
                // Redirect to a different page for non-admin users
                return redirect()->route('sales_dashboard');
            }
        }

        // Authentication failed...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {   
    Auth::logout();
    return redirect()->route('login');
    }
}