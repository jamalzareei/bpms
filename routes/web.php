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

    Route::get('/', 'DashboardController@index')->name('pages.dashboard');
    Route::post('/load-pi', 'DashboardController@loadPi')->name('pages.dashboard.load.pi');
    Route::get('/get-pis', 'DashboardController@getPis')->name('pages.dashboard.get.pis');

    Route::get('/user-list', 'UsersController@users')->name('pages.user.list');
    Route::post('/add-user', 'UsersController@addUser')->name('pages.add.user');
    Route::post('/update-user/{user_id}', 'UsersController@updateUser')->name('pages.update.user');

    
    Route::get('/roles-list', 'RolesController@roles')->name('pages.role.list');
    Route::post('/add-role', 'RolesController@addRole')->name('pages.add.role');

    
    Route::get('/links-list', 'LinksController@links')->name('pages.link.list');
    Route::post('/add-link', 'LinksController@addLink')->name('pages.add.link');
    Route::post('/update-link/{link_id}', 'LinksController@updateLink')->name('pages.update.link');

    Route::get('/customers-list', 'CustomersController@listCustomers')->name('pages.customers.list');
    Route::post('/customer-create', 'CustomersController@addCustomer')->name('pages.customer.create');
    Route::post('/update-customer/{customer_id}', 'CustomersController@updateCustomer')->name('pages.customer.update');
    Route::get('/customer-details', 'CustomersController@details')->name('pages.customer.details');

    Route::get('/products-list', 'ProductsController@listProducts')->name('pages.products.list');
    Route::post('/product-create', 'ProductsController@addProduct')->name('pages.product.create');
    Route::post('/update-product/{product_id}', 'ProductsController@updateProduct')->name('pages.product.update');

    Route::get('/pi-create', 'PisController@addPi')->name('pages.pi.create');
    Route::post('/pi-create', 'PisController@addPiPost')->name('pages.pi.create.post');
    Route::get('/pi-edit/{pi_id}', 'PisController@editPi')->name('pages.pi.edit');
    Route::post('/pi-update/{pi_id}', 'PisController@updatePi')->name('pages.pi.update');
    Route::get('/pis-list', 'PisController@listPis')->name('pages.pis.list');
    Route::post('/pi-add-customers-or-products', 'PisController@addCustomersOrProducts')->name('pages.pi.add.customers.products');
    Route::get('/pi-show/{id}', 'PisController@showPi')->name('pages.pi.show');
    Route::post('/upload-fille-pi/{id}', 'PisController@uploadFile')->name('pages.pi.upload.file');
    Route::get('/download-file/{id}', 'PisController@downloadFile')->name('pages.pi.download.file');
    Route::DELETE('/remove-file/{id}', 'PisController@removeFile')->name('pages.pi.remove.file');

    
    Route::get('/countries-list', 'CountriesController@countries')->name('pages.countries.list');
    Route::post('/add-country', 'CountriesController@addCountry')->name('pages.add.country');
    Route::post('/update-country/{country_id}', 'CountriesController@updateCountry')->name('pages.update.country');

    
    Route::get('/currencies-list', 'CurrenciesController@currencies')->name('pages.currencies.list');
    Route::post('/add-currency', 'CurrenciesController@addCurrency')->name('pages.add.currency');
    Route::post('/update-currency/{currency_id}', 'CurrenciesController@updateCurrency')->name('pages.update.currency');
    Route::get('/currency-details', 'CurrenciesController@details')->name('pages.currency.details');

    
    Route::get('/saletypes-list', 'SaletypesController@saletypes')->name('pages.saletypes.list');
    Route::post('/add-saletype', 'SaletypesController@addSaletype')->name('pages.add.saletype');
    Route::post('/update-saletype/{saletype_id}', 'SaletypesController@updateSaletype')->name('pages.update.saletype');
    
    Route::get('/factories-list', 'FactoriesController@factories')->name('pages.factories.list');
    Route::post('/add-factory', 'FactoriesController@addFactory')->name('pages.add.factory');
    Route::post('/update-factory/{factory_id}', 'FactoriesController@updateFactory')->name('pages.update.factory');
    Route::get('/factory-details', 'FactoriesController@details')->name('pages.factory.details');


    Route::get('user/create', 'UsersController@create')->name('user.create');

    // Route::post('user/login', 'UsersController@login')->name('user.login');

    Route::get('logout', function () {
        auth()->logout();

        return redirect()->route('login');
    })->name('log.out');

});
