<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

        if (auth()->check()) {
            return redirect()->route('pages.dashboard');
        }
        // session()->put('noty', [
        //     'title' => '',
        //     'message' => 'Please login to your account.',
        //     'status' => 'info',
        //     'data' => '',
        // ]);

        return view('components.login');
    }


    public function loginUser(Request $request)
    {
        $request->validate([
            'username' => "required|exists:users,username",
            'password' => "required"
        ]);

        
        $userdata = array(
            'username'     => $request->username,
            'password'  => $request->password
        );
        // return $userdata;
        // attempt to do the login
        if (Auth::attempt($userdata, true)) {
            // return auth()->user();
            
            session()->put('noty', [
                'title' => '',
                'message' => 'Login Successful.',
                'status' => 'success',
                'data' => '',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Login Successful.',
                'data' => $request,
                'autoRedirect' => route('pages.dashboard')
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Wrong username or password.',
            'data' => $request,
        ], 200);
        // return $request;
    }
}
