<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    
    public function create(Request $request)
    {
        # code...
        $card = new User;
        $card->username = 'amin';

        // $card->email = 'emails';
        $card->password = bcrypt('1234');
        $card->save();
        
        

    }

    public function login(Request $request)
    {
        return $request;
    }


}







