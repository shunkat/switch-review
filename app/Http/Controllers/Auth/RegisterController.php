<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use illuminate\Htpp\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        /* 
        Validation
        */
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        /*
        Database Insert
        */
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        // return redirect("/");
    }

    public function create()
    {
        return view('auth.register');
    }
}