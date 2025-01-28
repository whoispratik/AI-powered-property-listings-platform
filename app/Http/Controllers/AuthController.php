<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    //
    public function create(Request $request){
        if($request->user()){
            return redirect()->back();
        }
        return inertia('Auth/Login');
    }
    public function store(Request $request ){
       
    $credentials=$request->validate([
        'email'=>'required|email|string',
        'password'=>'required'
    ]);
    if(!Auth::attempt($credentials,$request->boolean('remember'))){
        throw ValidationException::withMessages([
            'email'=>'Authentication failed'    
        ]);
    }
    $request->session()->regenerate();
    return redirect()->intended('/listing');
    }

    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');

    }
}
