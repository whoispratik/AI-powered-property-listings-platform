<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserAccountController extends Controller
{
    //
    public function create(Request $request){
        if($request->user()){
            return redirect()->back();
        }
        return inertia('UserAccount/Create');
    }
    public function store(Request $request){
        $user = User::create($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]));
      //  $user->password = Hash::make($user->password); // DON'T ADD THIS LINE!!!
       // $user->save();
        Auth::login($user);
     
        return redirect()->route('listing.index')
            ->with('success', 'Account created!');
    }

}
