<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function Test(){
        $user = User::find(1);
        dd($user->link[0]);
    }
}
