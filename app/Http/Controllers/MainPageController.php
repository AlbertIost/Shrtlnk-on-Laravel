<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public static function Show(){
        return view('mainPage');
    }
}
