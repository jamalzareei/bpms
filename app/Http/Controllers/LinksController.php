<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class LinksController extends Controller
{
    //
    public function links(Request $request)
    {
        $links = Link::with('roles')->get();

        $roles = Role::all();


        $name = 'App\Http\Controllers';
        $routeCollection = Route::getRoutes(); // RouteCollection object
        $routes = $routeCollection->getRoutes(); // array of route objects

        // return $routes;
        //namespace: "App\Http\Controllers\PanelAdmin",
        $grouped_routes = array_filter($routes, function($route) use ($name) {
            $action = $route->getAction(); // getting route action
            if (isset($action['namespace'])) {

                // for the first level groups, $action['namespace'] 
                // will be a string
                // for nested groups, $action['namespace'] will be an array

                if (is_array($action['namespace'])) {
                    return in_array($name, $action['namespace']);
                } else {
                    return $action['namespace'] == $name;
                }
            }
            return false;
        });

        // return $grouped_routes;

        // return $links;//[0]->roles->pluck('id')->toArray();
        return view('pages.links.links-list',[
            'title' => 'Links list',
            'links' => $links,
            'roles' => $roles,
            'routes' => $grouped_routes,
        ]);
    }

    public function addLink(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            'place' => 'required',
            // 'icon' => 'nullable',
            'link_page' => 'required',
            'name' => 'required',
            'route' => 'required',
            'roles.*' => 'required',
        ]);

        $link = Link::create([
            'user_id' => auth()->id(),
            'name' => $request->name, 
            'slug' => $request->route, 
            'place_link' => $request->place, 
            'route_name' => $request->route, 
            'url' => $request->link_page, 
            'icon' => $request->icon, 
        ]);

        if($request->roles){
            $link->roles()->sync($request->roles);
        }

        session()->put('noty', [
            'title' => '',
            'message' => 'Add link Successful.',
            'status' => 'success',
            'data' => $link,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Add link Successful.',
            'data' => $link,
            'autoRedirect' => route('pages.link.list')
        ], 200);
    }

    public function updateLink(Request $request, $link_id)
    {
        # code...
        // return $request;
        
        $request->validate([
            'roles.*' => 'required',
        ]);
        $link = Link::find($link_id);

        
        if($request->roles){
            $link->roles()->sync($request->roles);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Link rolse updated.',
            'data' => $link,
        ], 200);
    }
}
