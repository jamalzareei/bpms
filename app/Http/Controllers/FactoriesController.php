<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Factory;
use Illuminate\Http\Request;

class FactoriesController extends Controller
{
    //
    public function factories(Request $request)
    {
        $factories = Factory::all();
        $countries = Country::all();

        return view('pages.factories.factories-list',[
            'title' => 'factories list',
            'factories' => $factories,
            'countries' => $countries,
        ]);
    }

    public function addFactory(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'country_id' => 'nullable|exists:countries,id',
        ]);

        $factory = Factory::create([
            'country_id' => $request->country_id,
            'name' => $request->name,
            // 'icon' => $request->icon,
            'code' => $request->code,
            'address' => $request->address,

        ]);

        session()->put('noty', [
            'title' => '',
            'message' => 'Add factory Successful.',
            'status' => 'success',
            'data' => $factory,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Add factory Successful.',
            'data' => $factory,
            'autoRedirect' => route('pages.factories.list')
        ], 200);
    }

    public function updateFactory(Request $request, $factory_id)
    {
        # code...
        // return $request;
        
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'country_id' => 'nullable|exists:countries,id',
        ]);
        
        $factory = Factory::find($factory_id);
        $factory->name = $request->name;
        $factory->code = $request->code;
        $factory->country_id = $request->country_id;
        $factory->save();

        return response()->json([
            'status' => 'success',
            'message' => 'factory rolse updated.',
            'data' => $factory,
        ], 200);
    }
}
