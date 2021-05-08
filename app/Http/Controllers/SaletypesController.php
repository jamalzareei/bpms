<?php

namespace App\Http\Controllers;

use App\Models\SaleType;
use Illuminate\Http\Request;

class SaletypesController extends Controller
{
    //
    public function saletypes(Request $request)
    {
        $saletypes = SaleType::all();

        return view('pages.saletypes.saletypes-list',[
            'title' => 'saletypes list',
            'saletypes' => $saletypes,
        ]);
    }

    public function addSaletype(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            'name' => 'required',
        ]);

        $saletype = SaleType::create([
            'name' => $request->name,

        ]);

        session()->put('noty', [
            'title' => '',
            'message' => 'Add saletype Successful.',
            'status' => 'success',
            'data' => $saletype,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Add saletype Successful.',
            'data' => $saletype,
            'autoRedirect' => route('pages.saletypes.list')
        ], 200);
    }

    public function updateSaletype(Request $request, $saletype_id)
    {
        # code...
        // return $request;
        
        $request->validate([
            'name' => 'required',
        ]);
        
        $saletype = SaleType::find($saletype_id);
        $saletype->name = $request->name;
        $saletype->save();

        return response()->json([
            'status' => 'success',
            'message' => 'saletype rolse updated.',
            'data' => $saletype,
        ], 200);
    }
}
