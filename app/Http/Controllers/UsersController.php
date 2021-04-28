<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
            'password'  => $request->password,
            'deleted_at' => null
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

    public function users(Request $request)
    {
        $users = User::with('roles')->get();

        $roles = Role::all();

        // return $users[0]->roles->pluck('id')->toArray();
        return view('pages.users.users-list',[
            'title' => 'Users list',
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function addUser(Request $request)
    {
        # code...
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'roles' => 'required',
            'roles.*' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        if($request->roles){
            $user->roles()->sync($request->roles);
        }

        session()->put('noty', [
            'title' => '',
            'message' => 'Add User Successful.',
            'status' => 'success',
            'data' => $user,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Add User Successful.',
            'data' => $user,
            'autoRedirect' => route('pages.user.list')
        ], 200);
    }

    public function updateUser(Request $request, $user_id)
    {
        # code...
        // return $request;
        
        $request->validate([
            'roles.*' => 'required',
        ]);
        $user = User::find($user_id);

        
        if($request->roles){
            $user->roles()->sync($request->roles);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'User rolse updated.',
            'data' => $user,
        ], 200);
    }
}
