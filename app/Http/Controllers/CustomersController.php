<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Factory;
use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    //
    public function listCustomers (Request $request)
    {
        # code...
        
        $customers = Customer::paginate(50);

        $countries = Country::all();
        $factories = Factory::all();


        // return $customers;
        return view('pages.customers.customers-list',[
            'title' => 'Customers list',
            'customers' => $customers,
            'countries' => $countries,
            'factories' => $factories,
        ]);
    }

    public function addCustomer(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            'username'=> 'nullable|exists:users,username',
            'country_id'=> 'required',
            'factory_id'=> 'required',
            'code'=> 'required',
            'name'=> 'required',
            'tell'=> 'required|min:10',
            'address'=> 'required|min:10',
        ]);

        $user = User::where('username', $request->username)->first();

        $customer  = Customer::create([
            'user_id' => $user->id ?? null,
            'country_id' => $request->country_id,
            'factory_id' => $request->factory_id,
            'name' => $request->name,
            'code' => $request->code,
            'tell' => $request->tell,
            'address' => $request->address,

        ]);

        
        return response()->json([
            'status' => 'success',
            'message' => 'Customer created successfully.',
            'data' => $customer,
            'autoRedirect' => route('pages.customers.list')
        ], 200);
    }

    public function updateCustomer(Request $request, $customer_id)
    {
        # code...
        $request->validate([
            'username'=> 'nullable|exists:users,username',
            'country_id'=> 'required',
            'factory_id'=> 'required',
            'code'=> 'required',
            'name'=> 'required',
            'tell'=> 'required|min:10',
        ]);

        $customer  = Customer::where('id', $customer_id)->update([
            'country_id' => $request->country_id,
            'factory_id' => $request->factory_id,
            'name' => $request->name,
            'code' => $request->code,
            'tell' => $request->tell,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Customer updated successfully.',
            'data' => $customer,
            'autoRedirect' => route('pages.customers.list')
        ], 200);
    }
}
