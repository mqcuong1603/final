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
    
        if ($request->input('formType') === 'admin') {
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('admin.admin_dashboard');
            }
        } else {
            if (Auth::guard('salesman')->attempt($credentials)) {
                return redirect()->route('sales.sales_dashboard');
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