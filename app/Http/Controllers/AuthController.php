<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    function login()
    {
        return view('auth.login');
    }

    function register()
    {
        return view('auth.register');
    }

    function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|min:5|max:12|confirmed',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $save = $user->save();
        if ($save) {
            // create customer profile
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();
            return redirect('/');
            // TODO: edit route
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}