<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Factory;
use Carbon\Carbon;
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
            'phone_number' => 'required',
            'address' => 'required',
            'country_id' => 'nullable|exists:countries,id',
        ]);

        $factory = Factory::create([
            'country_id' => $request->country_id,
            'name' => $request->name,
            // 'icon' => $request->icon,
            'code' => $request->code,
            'phone_number' => $request->phone_number,
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
            'phone_number' => 'required',
            'country_id' => 'nullable|exists:countries,id',
        ]);
        
        $factory = Factory::find($factory_id);
        $factory->name = $request->name;
        $factory->code = $request->code;
        $factory->phone_number = $request->phone_number;
        $factory->country_id = $request->country_id;
        $factory->save();

        return response()->json([
            'status' => 'success',
            'message' => 'factory rolse updated.',
            'data' => $factory,
        ], 200);
    }
    
    public function details(Request $request)
    {
        # code...
        $factory = Factory::where('id', $request->factory_id)->first();

        return response()->json([
            'factory' => $factory
        ], 200);
    }
    
    public function removeFactory(Request $request, $factory_id)
    {
        # code...
        
        $factory = Factory::find($factory_id);
        $factory->deleted_at = Carbon::now();
        $factory->save();

        return response()->json([
            'status' => 'success',
            'message' => 'factory removed successfuly.',
            'data' => $factory,
        ], 200);
    }
}
