<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // $user = User::create([
    //     'name' => 'jamal', 
    //     'email' => 'admin@admin.com',  
    //     'password' => bcrypt('1430548')
    // ]);
    $user = User::find(1);
    Auth::login($user);
    return auth()->user();
    // return view('welcome');
});

// Route::get('/', 'HomeController')->name('index');
// Route::get('/login', 'HomeController')->name('login');