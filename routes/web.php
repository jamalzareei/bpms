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
    // $user = User::find(1);
    // Auth::login($user);
    // return auth()->user();
    return view('pages.dashboard');
});

Route::get('/login', function () {    return view('components.login');});



Route::get('user/create', 'UsersController@create')->name('user.create');

Route::post('user/login', 'UsersController@login')->name('user.login');






// Route::get('/register', function () {    return view('components.register');});
// Route::get('/forget-password', function () {    return view('components.forgetPassword');});
// Route::get('/reset-password', function () {    return view('components.resetPassword');});


// Route::get('/', 'HomeController')->name('index');
// Route::get('/login', 'HomeController')->name('login');