<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AuthCntrl extends Controller
{
    public function admin_UserLogin()
    {
        // dd(Hash::make(123456));
        if(!empty(Auth::check()) && Auth::user()->is_admin == 1)
        {
            return redirect('admin-dashboard');
        }
        return view('admin.auth.login-admin');
    }
    public function admin_UserLogin_authenticated(request $request)
    {
        // dd($request->all());
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 0 , 'is_delete' => 0], $remember))
        {
            return redirect('admin-dashboard');
        }
        else
        {
            return redirect()->back()->with('error', "please enter correct email and password");
        }
    }
    public function admin_logout()
    {
        Auth::logout();
        return redirect('admin-login');
    }
}
