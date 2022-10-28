<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainPageController::class, 'Show']);

Route::get('/test', [UserController::class, 'Test'])->name('test1');
Route::get('/test2', [UserController::class, 'Test'])->name('test2');

Route::post('/tryaccess/{token}', [LinkController::class, 'TryAccessToClosedPage'])->name('tryAccessToClosedPage');

Route::name('user.')->group(function () {
    Route::get('/login', function(){
        if(Auth::check()){
            return redirect(route('user.dashboard'));
        }
        else{
            return view('sign.sign-in');
        }
    })->name('login');

    Route::get('/registration', function(){
        if(Auth::check()){
            return redirect(route('user.dashboard'));
        }
        else{
            return view('sign.sign-up');
        }
    })->name('registration');

    Route::post('/registration', [RegisterController::class, 'save']);

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/dashboard', function (){
        return view('user.dashboard');
    })->middleware('auth')->name('dashboard');

    Route::prefix('links')->group(function(){
        Route::get('/create', function (){
            return view('user.cut_down');
        })->middleware('auth')->name('links.create');

        Route::get('/groups', function (){
            return view('user.groups');
        })->middleware('auth')->name('links.groups');

        Route::get('/', [LinkController::class, 'GetUserLinks'])->middleware('auth')->name('links');

        Route::get('/{id}/edit', [LinkController::class, 'ShowEditLinkPage'])->middleware('auth')->name('links.edit');
    });

    Route::get('/logout', function(){
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

Route::get('/test', [UserController::class, 'Test']);

Route::get('/{token}', [LinkController::class, 'ShortToLong']);
