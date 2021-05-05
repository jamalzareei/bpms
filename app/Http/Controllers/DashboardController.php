<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        # code...
        
        $customers = Customer::select('id', 'name')->with(['pis' => function($query) {$query->select('id');}])->get();

        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'customers' => $customers,
        ]);
    }

    public function loadPi(Request $request)
    {
        # code...
        $request->validate([
            'code' => 'required|exists:pis,code'
        ]);

        $pi = Pi::where('code', $request->code)->first();
        if(!$pi){
            return response()->json([
                'errors' => [
                    'code' => 'PI not Found'
                ]
            ], 422);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'Pi created successfully.',
            'autoRedirect' => route('pages.pi.show', ['id' => $pi->id])
        ], 200);
    }

    public function getPis(Request $request)
    {
        # code...
    }
}
