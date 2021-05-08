<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    //
    public function countries(Request $request)
    {
        $countries = Country::all();

        return view('pages.countries.countries-list',[
            'title' => 'countries list',
            'countries' => $countries,
        ]);
    }

    public function addCountry(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            // 'area_code' => 'required',
        ]);

        $country = Country::create([
            'name' => $request->name,
            // 'flag' => $request->name,
            'code' => $request->code,
            'area_code' => $request->area_code,

        ]);

        session()->put('noty', [
            'title' => '',
            'message' => 'Add country Successful.',
            'status' => 'success',
            'data' => $country,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Add country Successful.',
            'data' => $country,
            'autoRedirect' => route('pages.countries.list')
        ], 200);
    }

    public function updateCountry(Request $request, $country_id)
    {
        # code...
        // return $request;
        
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        
        $country = Country::find($country_id);
        $country->name = $request->name;
        $country->code = $request->code;
        $country->area_code = $request->area_code;
        $country->save();

        return response()->json([
            'status' => 'success',
            'message' => 'country rolse updated.',
            'data' => $country,
        ], 200);
    }
}
