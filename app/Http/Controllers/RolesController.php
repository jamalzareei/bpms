<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    //
    public function roles(Request $request)
    {
        $roles = Role::withCount('users')->get();

        // return $roles;
        return view('pages.roles.roles-list',[
            'title' => 'Roles list',
            'roles' => $roles,
        ]);
    }

    public function addRole(Request $request)
    {
        # code...
        $request->validate([
            'name' => 'required',
        ]);

        $user = Role::create([
            'name' => $request->name,
            'slug' => str_replace(' ','-', $request->name),
        ]);


        session()->put('noty', [
            'title' => '',
            'message' => 'Add Role Successful.',
            'status' => 'success',
            'data' => $user,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Add Role Successful.',
            'data' => $user,
            'autoRedirect' => route('pages.role.list')
        ], 200);
    }
}
