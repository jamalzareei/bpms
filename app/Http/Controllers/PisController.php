<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pi;
use App\Models\Product;
use Illuminate\Http\Request;

class PisController extends Controller
{
    //
    
    public function listPis(Request $request)
    {
        # code...
        $pis = Pi::with(['products', 'customers'])->paginate(50);
        $customers = Customer::select('id', 'name')->with(['pis' => function($query) {$query->select('id');}])->get();
        $products = Product::select('id', 'name')->with(['pis' => function($query) {$query->select('id');}])->get();

        return view('pages.pis.pis-list', [
            'title' => 'Pis List',
            'pis' => $pis,
            'customers' => $customers,
            'products' => $products,
        ]);
    }

    public function addPi(Request $request)
    {
        # code...
        return view('pages.pis.add-pi', [
            'title' => 'Add New Pi'
        ]);
    }

    public function addPiPost(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            'code' => 'required',
            'booking' => 'required|numeric',
            'confirm_at' => 'required',
            'issud_at' => 'required',
            'producing' => 'required|numeric',
            'stock' => 'required|numeric',
            'trucks_factory' => 'required|numeric',
            'trucks_on_border' => 'required|numeric',
            'trucks_on_way' => 'required|numeric',
            'trucks_vend_on_way' => 'required|numeric',
        ]);

        $pi = Pi::create([
            'code' => $request->code,
            'booking' => $request->booking,
            'confirm_at' => $request->confirm_at,
            'issud_at' => $request->issud_at,
            'producing' => $request->producing,
            'stock' => $request->stock,
            'trucks_factory' => $request->trucks_factory,
            'trucks_on_border' => $request->trucks_on_border,
            'trucks_on_way' => $request->trucks_on_way,
            'trucks_vend_on_way' => $request->trucks_vend_on_way,
        ]);

        
        return response()->json([
            'status' => 'success',
            'message' => 'Pi created successfully.',
            'data' => $pi,
            // 'autoRedirect' => route('pages.customers.list')
        ], 200);
    }

    public function showPi(Request $request, $id)
    {
        # code...
        $pi = Pi::find($id);

        return $pi;
    }

    public function addCustomersOrProducts(Request $request)
    {
        # code...
        $request->validate([
            'pi_id' => 'required|exists:pis,id',
            'customers' => 'required',
            'products' => 'required',
            'customers.*' => 'required|exists:customers,id',
            'products.*' => 'required|exists:products,id'
        ]);
        // return $request->products;

        $pi = Pi::find($request->pi_id);

        if($pi && $request->customers){
            $pi->customers()->sync($request->customers);
        }

        if($pi && $request->products){
            $pi->products()->sync($request->products);
        }

        
        
        return response()->json([
            'status' => 'success',
            'message' => 'added successfully.',
            'data' => $pi,
            // 'autoRedirect' => route('pages.customers.list')
        ], 200);

    }

}
