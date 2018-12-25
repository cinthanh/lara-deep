<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin');// @TODO:
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        // validate form login for admin
        $this->validate($request, [
            'email'     => 'required|email|max:50',
            'password'  => 'required|min:5'
        ]);
        // Attempt to log the user in
        if ( Auth::guard('admin')->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ], $request->remember)
        ) {
            // if successful: redirect to dashboard
            return redirect()->intended('admin.dashboard');
        }
        return redirect()->back()->withInput($request->only('email','remember'));

        // if unsuccessful redirect back with error


    }

}
