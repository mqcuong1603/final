<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if ($request->input('formType') === 'admin') {
            $admin = User::where('username', $username)->first();
            if ($admin && Auth::guard('admin')->attempt(['username' => $username, 'password' => $password])) {
                return redirect()->route('admin.admin_dashboard');
            } else {
                $errorMessage = 'Invalid password or email';
                return back()->withErrors([
                    'username' => $errorMessage,
                ]);
            }
        } else {
            if (Auth::guard('salesman')->attempt(['username' => $username, 'password' => $password])) {
                $salesman = Auth::guard('salesman')->user();
                if ($salesman->isLocked) {
                    Auth::logout();
                    return back()->withErrors([
                        'username' => 'Your account has been locked. Please contact the administrator.',
                    ]);
                } elseif ($salesman->is_first_login) {
                    return redirect()->route('sales.changePassword', ['email' => $salesman->email]);
                } else {
                    return redirect()->route('sales.sales_dashboard');
                }
            } else {
                return back()->withErrors([
                    'username' => 'Invalid password or email',
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
