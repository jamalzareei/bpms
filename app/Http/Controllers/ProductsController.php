<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function listProducts (Request $request)
    {
        # code...
        
        $products = Product::paginate(50);


        // return $users[0]->roles->pluck('id')->toArray();
        return view('pages.products.products-list',[
            'title' => 'Products list',
            'products' => $products,
        ]);
    }

    public function addProduct(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            'code'=> 'required',
            'name'=> 'required',
        ]);

        $product  = Product::create([
            'code'=> $request->code,
            'name'=> $request->name,
        ]);

        
        return response()->json([
            'status' => 'success',
            'message' => 'product created successfully.',
            'data' => $product,
            'autoRedirect' => route('pages.products.list')
        ], 200);
    }

    public function updateProduct(Request $request, $product_id)
    {
        # code...
        $request->validate([
            'code'=> 'required',
            'name'=> 'required',
        ]);

        $product  = Product::where('id', $product_id)->update([
            'code'=> $request->code,
            'name'=> $request->name,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'product updated successfully.',
            'data' => $product,
            'autoRedirect' => route('pages.products.list')
        ], 200);
    }
}
