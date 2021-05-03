<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    //
    public function listCustomers (Request $request)
    {
        # code...
        
        $customers = Customer::paginate(50);


        // return $users[0]->roles->pluck('id')->toArray();
        return view('pages.customers.customers-list',[
            'title' => 'Customers list',
            'customers' => $customers,
        ]);
    }

    public function addCustomer(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            'code'=> 'required',
            'name'=> 'required',
            'tell'=> 'required|min:10',
            'address'=> 'required|min:10',
        ]);

        $customer  = Customer::create([
            'code'=> $request->code,
            'name'=> $request->name,
            'tell'=> $request->tell,
            'address'=> $request->address,
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
            'code'=> 'required',
            'name'=> 'required',
            'tell'=> 'required|min:10',
        ]);

        $customer  = Customer::where('id', $customer_id)->update([
            'code'=> $request->code,
            'name'=> $request->name,
            'tell'=> $request->tell,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Customer updated successfully.',
            'data' => $customer,
            'autoRedirect' => route('pages.customers.list')
        ], 200);
    }
}
