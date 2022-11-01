<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function save(Request $request){
        if(Auth::check())
            return redirect(route('user.dashboard'));

        $validateFields = $request->validate([
            'name' => 'required|regex:/[a-zA-Z]+/',
            'email' => 'required|unique:users,email|email',
            'password' => 'required',
        ]);


        $user = User::create($validateFields);
        if($user){
            auth()->login($user);
            return redirect(route('user.dashboard'));
        }

        return redirect(route('user.registration'))->withErrors([
            'registration error' => 'An error occurred during registration'
        ]);
    }
}
