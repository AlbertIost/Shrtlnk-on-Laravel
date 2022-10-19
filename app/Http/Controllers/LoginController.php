<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        if(Auth::check())
            return redirect(route('user.dashboard'));

        $formFields = $request->only('email', 'password');

        if(Auth::attempt($formFields)){
            return redirect()->intended(route('user.dashboard'));
        }

        return redirect(route('user.login'))->withErrors([
            'email' => 'Не удалось авторизоваться'
        ]);
    }
}
