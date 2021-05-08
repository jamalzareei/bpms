<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    //
    public function currencies(Request $request)
    {
        $currencies = Currency::all();

        return view('pages.currencies.currencies-list',[
            'title' => 'currencies list',
            'currencies' => $currencies,
        ]);
    }

    public function addcurrency(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            'name' => 'required',
            // 'code' => 'required',
            'rate' => 'nullable|numeric',
        ]);

        $currency = Currency::create([
            'name' => $request->name,
            // 'flag' => $request->name,
            // 'code' => $request->code,
            'rate' => $request->rate,

        ]);

        session()->put('noty', [
            'title' => '',
            'message' => 'Add currency Successful.',
            'status' => 'success',
            'data' => $currency,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Add currency Successful.',
            'data' => $currency,
            'autoRedirect' => route('pages.currencies.list')
        ], 200);
    }

    public function updatecurrency(Request $request, $currency_id)
    {
        # code...
        // return $request;
        
        $request->validate([
            'name' => 'required',
            // 'code' => 'required',
            'rate' => 'nullable|numeric',
        ]);
        
        $currency = Currency::find($currency_id);
        $currency->name = $request->name;
        $currency->rate = $request->rate;
        $currency->save();

        return response()->json([
            'status' => 'success',
            'message' => 'currency rolse updated.',
            'data' => $currency,
        ], 200);
    }
}
