<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PisController extends Controller
{
    //
    public function addPi(Request $request)
    {
        # code...
        return view('pages.pis.add-pi', [
            'title' => 'Add New Pi'
        ]);
    }
}
