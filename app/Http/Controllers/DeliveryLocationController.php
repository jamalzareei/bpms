<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DeliveryLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryLocationController extends Controller
{
    //
    public function deliveryLocation(Request $request)
    {
        $deliveries = DeliveryLocation::all();
        
        $customers = Customer::all();

        return view('pages.deliveries.deliveries-list',[
            'title' => 'deliveries list',
            'customers' => $customers,
            'deliveries' => $deliveries,
        ]);
    }

    public function addDeliveryLocation(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            'name' => 'required',
            'customer_id' => 'required|exists:customers,id',
        ]);

        DeliveryLocation::where('name', $request->name)->update(['deleted_at'=> Carbon::now()]);

        $delivery = DeliveryLocation::create([
            'name' => $request->name,
            'customer_id' => $request->customer_id,
        ]);

        session()->put('noty', [
            'title' => '',
            'message' => 'Add delivery Successful.',
            'status' => 'success',
            'data' => $delivery,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'delivery location added Successful.',
            'data' => $delivery,
            'autoRedirect' => route('pages.delivery.location.list')
        ], 200);
    }

    public function updateDeliveryLocation(Request $request, $delivery_id)
    {
        # code...
        // return $request;
        
        $request->validate([
            'name' => 'required',
            'customer_id' => 'required|exists:customers,id',
        ]);
        
        $delivery = DeliveryLocation::find($delivery_id);
        $delivery->name = $request->name;
        $delivery->customer_id = $request->customer_id;
        $delivery->save();

        return response()->json([
            'status' => 'success',
            'message' => 'delivery location updated successfuly.',
            'data' => $delivery,
        ], 200);
    }

    
    public function removeDeliveryLocation(Request $request, $delivery_id)
    {
        # code...
        
        $delivery = DeliveryLocation::find($delivery_id);
        $delivery->deleted_at = Carbon::now();
        $delivery->save();

        return response()->json([
            'status' => 'success',
            'message' => 'delivery location removed successfuly.',
            'data' => $delivery,
        ], 200);
    }
}
