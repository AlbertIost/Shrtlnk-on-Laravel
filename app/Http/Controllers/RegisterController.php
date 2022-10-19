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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(User::where('email', '=', $validateFields['email'])->exists()){
            return redirect(route('user.registration'))->withErrors([
                'email' => 'Почта занята'
            ]);
        }

        $user = User::create($validateFields);
        if($user){
            auth()->login($user);
            return redirect(route('user.dashboard'));
        }

        return redirect(route('user.registration'))->withErrors([
            'registration error' => 'Произошла ошибка при регистрации'
        ]);
    }
}
