<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Factory;
use App\Models\Pi;
use App\Models\Product;
use App\Models\SaleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PisController extends Controller
{
    //

    public function listPis(Request $request)
    {
        # code...
        $pis = Pi::with(['products', 'customer'])->paginate(50);
        $customers = Customer::all();
        $products = Product::select('id', 'name')->with(['pis' => function ($query) {
            $query->select('id');
        }])->get();

        // return  $pis;
        return view('pages.pis.pis-list', [
            'title' => 'Pis List',
            'pis' => $pis,
            // 'customers' => $customers,
            'products' => $products,
        ]);
    }

    public function addPi(Request $request)
    {
        # code...
        $customers = Customer::all();
        $saletypes = SaleType::all();
        $currencies = Currency::all();
        $factories = Factory::all();
        return view('pages.pis.add-pi', [
            'title' => 'Add New Pi',
            'customers' => $customers,
            'saletypes' => $saletypes,
            'currencies' => $currencies,
            'factories' => $factories,
        ]);
    }

    public function addPiPost(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            'validity_date' => 'required',
            'currency_id' => 'required|exists:currencies,id',
            'currency_rate' => 'required|numeric',
            'customer_id' => 'required|exists:customers,id',
            'factory_id' => 'required|exists:factories,id',
            'date' => 'required',
            // 'delivery_location' => 'required',
            'extra_code' => 'nullable|numeric',
            // 'number' => 'required|numeric',
            // 'address' => 'nullable|min:10',
            'saletype_id' => 'required|exists:sale_types,id',

            'booking' => 'nullable|numeric',
            'confirm_at' => 'nullable',
            'issud_at' => 'nullable',
            'producing' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'trucks_factory' => 'nullable|numeric',
            'trucks_on_border' => 'nullable|numeric',
            'trucks_on_way' => 'nullable|numeric',
            'trucks_vend_on_way' => 'nullable|numeric',
        ]);

        $customer = Customer::where('id', $request->customer_id)->with('country')->first();
        $factory = Factory::where('id', $request->factory_id)->first();

        if (!($customer && $customer->code && $factory && $factory->code && $customer->country && $customer->country->code)) {
            return response()->json([
                'status' => 'error',
                'message' => 'code customer not found.',
            ], 200);
        }
        
        DB::table('customer_factory')->updateOrInsert([
            'customer_id' => $customer->id,
            'factory_id' => $factory->id,
        ],[]);
        // return $factory;
        $code = $customer->country->code . '-' . $customer->code . '-' . $factory->code . '-' . date("md", strtotime($request->date));// . '-' . $request->extra_code;
        $code = $this->createCode($code);

        $pi = Pi::create([
            'code' => $code,
            'user_id' => auth()->id(),
            'customer_id' => $request->customer_id,
            'factory_id' => $request->factory_id,
            'date' => $request->date,
            'sale_type_id' => $request->saletype_id,
            // 'address' => $request->address,
            'delivery_location' => $request->delivery_location,
            'customer_name' => $customer->name,
            'customer_name2' => $customer->name,
            // 'number' => $request->number,
            'validity_date' => $request->validity_date,
            'currency_id' => $request->currency_id,
            'currency_rate' => $request->currency_rate,
            'details' => $request->currency_rate,
            'issud_at' => $request->issud_at,
            'confirm_at' => $request->issud_at,
            'producing' => $request->producing,
            'stock' => $request->stock,
            'booking' => $request->booking,
            'trucks_factory' => $request->trucks_factory,
            'trucks_on_way' => $request->trucks_on_way,
            'trucks_on_border' => $request->trucks_on_border,
            'trucks_vend_on_way' => $request->trucks_vend_on_way,

        ]);



        return response()->json([
            'status' => 'success',
            'message' => 'Pi created successfully.',
            'data' => $pi,
            'autoRedirect' => route('pages.pi.edit', ['pi_id' => $pi->id])
        ], 200);
    }

    public function editPi(Request $request, $pi_id)
    {
        # code...
        $pi = Pi::find($pi_id);
        $customers = Customer::all();
        $saletypes = SaleType::all();
        $currencies = Currency::all();
        $factories = Factory::all();
        return view('pages.pis.edit-pi', [
            'title' => 'update New Pi ' . $pi->code,
            'code' => explode('-', $pi->code),
            'pi' => $pi,
            'customers' => $customers,
            'saletypes' => $saletypes,
            'currencies' => $currencies,
            'factories' => $factories,
        ]);
    }

    public function updatePi(Request $request, $pi_id)
    {
        # code...
        // return $request;
        $request->validate([
            'validity_date' => 'required',
            'currency_id' => 'required|exists:currencies,id',
            'currency_rate' => 'required|numeric',
            'factory_id' => 'required|exists:factories,id',
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required',
            // 'delivery_location' => 'required',
            'extra_code' => 'nullable|numeric',
            // 'number' => 'required|numeric',
            // 'address' => 'nullable|min:10',
            'saletype_id' => 'required|exists:sale_types,id',
            'booking' => 'nullable|numeric',
            'confirm_at' => 'nullable',
            'issud_at' => 'nullable',
            'producing' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'trucks_factory' => 'nullable|numeric',
            'trucks_on_border' => 'nullable|numeric',
            'trucks_on_way' => 'nullable|numeric',
            'trucks_vend_on_way' => 'nullable|numeric',
        ]);

        $customer = Customer::where('id', $request->customer_id)->with('factory', 'country')->first();
        
        $factory = Factory::where('id', $request->factory_id)->first();

        if (!($customer && $customer->code && $factory && $factory->code && $customer->country && $customer->country->code)) {
            return response()->json([
                'status' => 'error',
                'message' => 'code customer not found.',
            ], 200);
        }

        DB::table('customer_factory')->updateOrInsert([
            'customer_id' => $customer->id,
            'factory_id' => $factory->id,
        ],[]);

        $code = $customer->country->code . '-' . $customer->code . '-' . $factory->code . '-' . date("dm", strtotime($request->date));// . '-' . $request->extra_code;
        $code = $this->createCode($code);


        $pi = Pi::where('id', $pi_id)->update([
            'code' => $code,
            'user_id' => auth()->id(),
            'customer_id' => $request->customer_id,
            'factory_id' => $request->factory_id,
            'date' => $request->date,
            'sale_type_id' => $request->saletype_id,
            // 'address' => $request->address,
            'delivery_location' => $request->delivery_location,
            'customer_name' => $customer->name,
            'customer_name2' => $customer->name,
            // 'number' => $request->number,
            'validity_date' => $request->validity_date,
            'currency_id' => $request->currency_id,
            'currency_rate' => $request->currency_rate,
            'details' => $request->currency_rate,
            'issud_at' => $request->issud_at,
            'confirm_at' => $request->issud_at,
            'producing' => $request->producing,
            'stock' => $request->stock,
            'booking' => $request->booking,
            'trucks_factory' => $request->trucks_factory,
            'trucks_on_way' => $request->trucks_on_way,
            'trucks_on_border' => $request->trucks_on_border,
            'trucks_vend_on_way' => $request->trucks_vend_on_way,

        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'Pi created successfully.',
            'data' => $pi,
        ], 200);
    }

    public function createCode($code)
    {
        # code...
        $piCount = Pi::where('code', $code)->count();
        if($piCount){
            $code = $code."-".($piCount + 1);
        }
        return $code;
    }

    public function showPi(Request $request, $id)
    {
        # code...
        $pi = Pi::find($id);

        // return $pi;
        return view('pages.pis.pi-show', [
            'title' => 'PI details',
            'pi' => $pi,
        ]);
    }

    public function addCustomersOrProducts(Request $request)
    {
        # code...
        $request->validate([
            'pi_id' => 'required|exists:pis,id',
            'customers' => 'required',
            'products' => 'required',
            'customers.*' => 'required|exists:customers,id',
            'products.*' => 'required|exists:products,id'
        ]);
        // return $request->products;

        $pi = Pi::find($request->pi_id);

        if ($pi && $request->customers) {
            $pi->customers()->sync($request->customers);
        }

        if ($pi && $request->products) {
            $pi->products()->sync($request->products);
        }



        return response()->json([
            'status' => 'success',
            'message' => 'added successfully.',
            'data' => $pi,
            // 'autoRedirect' => route('pages.customers.list')
        ], 200);
    }
}
