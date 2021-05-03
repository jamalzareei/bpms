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


Route::get('/login', 'UsersController@login')->name('login');
Route::post('/login', 'UsersController@loginUser')->name('login.user.post');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('pages.dashboard');

    Route::get('/user-list', 'UsersController@users')->name('pages.user.list');
    Route::post('/add-user', 'UsersController@addUser')->name('pages.add.user');
    Route::post('/update-user/{user_id}', 'UsersController@updateUser')->name('pages.update.user');

    
    Route::get('/roles-list', 'RolesController@roles')->name('pages.role.list');
    Route::post('/add-role', 'RolesController@addRole')->name('pages.add.role');

    
    Route::get('/links-list', 'LinksController@links')->name('pages.link.list');
    Route::post('/add-link', 'LinksController@addLink')->name('pages.add.link');
    Route::post('/update-link/{link_id}', 'LinksController@updateLink')->name('pages.update.link');

    Route::get('/pi-create', 'PisController@addPi')->name('pages.pi.create');

    Route::get('/customers-list', 'CustomersController@listCustomers')->name('pages.customers.list');
    Route::post('/customer-create', 'CustomersController@addCustomer')->name('pages.customer.create');
    Route::post('/update-customer/{customer_id}', 'CustomersController@updateCustomer')->name('pages.customer.update');

    Route::get('/products-list', 'ProductsController@listProducts')->name('pages.products.list');
    Route::post('/product-create', 'ProductsController@addProduct')->name('pages.product.create');
    Route::post('/update-product/{product_id}', 'ProductsController@updateProduct')->name('pages.product.update');



    Route::get('user/create', 'UsersController@create')->name('user.create');

    // Route::post('user/login', 'UsersController@login')->name('user.login');

    Route::get('logout', function () {
        auth()->logout();

        return redirect()->route('login');
    })->name('log.out');

});
