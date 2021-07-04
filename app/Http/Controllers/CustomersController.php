<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Factory;
use App\Models\Notification;
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
            // 'factory_id'=> 'required',
            'code'=> 'required',
            'name'=> 'required',
            'tell'=> 'required|min:10',
            'address'=> 'required|min:10',
        ]);

        $user = User::where('username', $request->username)->first();

        $customer  = Customer::create([
            'user_id' => $user->id ?? null,
            'country_id' => $request->country_id,
            // 'factory_id' => $request->factory_id,
            'name' => $request->name,
            'code' => $request->code,
            'tell' => $request->tell,
            'address' => $request->address,

        ]);
        
        Notification::create([
            'sender_id' => auth()->id(),
            'user_id' => $user->id,
            'title' => 'add to customers',
            'message' => 'You added to Customers',
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
            // 'factory_id'=> 'required',
            'code'=> 'required',
            'name'=> 'required',
            'tell'=> 'required|min:10',
        ]);

        $customer  = Customer::find('id');
        
        
        $customer->country_id = $request->country_id;
        $customer->name = $request->name;
        $customer->code = $request->code;
        $customer->tell = $request->tell;
        $customer->save();

        
        Notification::create([
            'sender_id' => auth()->id(),
            'user_id' => $customer->user_id,
            'title' => 'update to customers',
            'message' => 'Your data customer updateed',
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Customer updated successfully.',
            'data' => $customer,
            'autoRedirect' => route('pages.customers.list')
        ], 200);
    }

    public function details(Request $request)
    {
        # code...
        $customer = Customer::where('id', $request->customer_id)->with('factory', 'country')->first();

        return response()->json([
            'customer' => $customer
        ], 200);
    }
}
