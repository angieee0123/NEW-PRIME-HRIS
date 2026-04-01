<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //Show login form
    public function showLogin()
    {
        return view('login');
    }

    //Handle login form submission
    public function login(Request $request){
    //Simple Validation
    $request->validate([
        'email'=>'required|email',
        'password'=>'required|min:4'
    ]);

    //Temporary login check (sample only)
    if ($request->email==='admin@test.com' && $request->password ==='123'){
        return "Login successful💕";
    }

        return back()->with('error','Invalid credentials!');
    }




}
