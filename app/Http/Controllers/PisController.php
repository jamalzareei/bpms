<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\DeliveryLocation;
use App\Models\Factory;
use App\Models\File;
use App\Models\Notification;
use App\Models\Pi;
use App\Models\PiUser;
use App\Models\Product;
use App\Models\SaleType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $deliveries = DeliveryLocation::all();
        return view('pages.pis.add-pi', [
            'title' => 'Add New Pi',
            'customers' => $customers,
            'saletypes' => $saletypes,
            'currencies' => $currencies,
            'factories' => $factories,
            'deliveries' => $deliveries,
        ]);
    }

    public function addPiPost(Request $request)
    {
        # code...
        // return $request;
        $request->validate([
            // 'validity_date' => 'required',
            'currency_id' => 'required|exists:currencies,id',
            'currency_rate' => 'required|numeric',
            'customer_id' => 'required|exists:customers,id',
            'factory_id' => 'required|exists:factories,id',
            'date' => 'required',
            'delivery_location_id' => 'nullable|exists:delivery_locations,id',
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
            'user_access_username' => 'required|exists:users,username'
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
        ], []);
        // return $factory;
        $code = $customer->country->code . '-' . $customer->code . '-' . $factory->code . '-' . date("dm", strtotime($request->date)); // . '-' . $request->extra_code;
        
        $existCode = Pi::where('code', $code)->first();
        if($existCode){
            return response()->json([
                'status' => 'error',
                'errors' => ['code' => 'PI code used, please change PI code'],
            ], 422);
        }

        if($request->currency_rate > 0){
            Currency::where('id', $request->currency_id)->update(['rate'=> $request->currency_rate]);
        }
        $pi = Pi::create([
            'code' => $code,
            'user_id' => auth()->id(),
            'customer_id' => $request->customer_id,
            'factory_id' => $request->factory_id,
            'date' => $request->date,
            'sale_type_id' => $request->saletype_id,
            // 'address' => $request->address,
            'delivery_location_id' => $request->delivery_location_id,
            'customer_name' => $customer->name,
            'customer_name2' => $customer->name,
            // 'number' => $request->number,
            'quantity' => $request->quantity,
            'pallet' => $request->pallet,
            'truck' => $request->truck,
            'validity_date' => Carbon::parse($request->date)->addMonth(1),
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

        $userAccess = User::where('username', $request->user_access_username)->first();
        PiUser::create([
            'user_id' => $userAccess->id,
            'pi_id' => $pi->id,
            'sender_id' => auth()->user()->id,
            'details' => '',
        ]);
        
        Notification::create([
            'sender_id' => auth()->id(),
            'user_id' => $userAccess->id,
            'title' => 'PI was sent to you',
            'message' => "PI was sent to you. $pi->code.",
        ]);

        Notification::create([
            'sender_id' => auth()->id(),
            'user_id' => $customer->user_id,
            'title' => 'add new PI',
            'message' => "add PI with your customer data with code $code.",
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
        $deliveries = DeliveryLocation::all();
        return view('pages.pis.edit-pi', [
            'title' => 'update New Pi ' . $pi->code,
            'code' => explode('-', $pi->code),
            'pi' => $pi,
            'customers' => $customers,
            'saletypes' => $saletypes,
            'currencies' => $currencies,
            'factories' => $factories,
            'deliveries' => $deliveries,
        ]);
    }

    public function updatePi(Request $request, $pi_id)
    {
        # code...
        // return $request;
        $request->validate([
            'currency_id' => 'required|exists:currencies,id',
            'currency_rate' => 'required|numeric',
            // 'factory_id' => 'required|exists:factories,id',
            // 'customer_id' => 'required|exists:customers,id',
            // 'date' => 'required',
            'delivery_location_id' => 'nullable|exists:delivery_locations,id',
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
            'user_access_username' => 'required|exists:users,username'
        ]);
        
        $pi = Pi::where('id', $pi_id)->with('useraccess')->first();
        if($pi && $pi->useraccess && $pi->useraccess->id && auth()->user()->id != $pi->useraccess->user_id){
            
            return response()->json([
                'title' => '',
                'message' => 'You do not have access to this section.',
                'status' => 'error',
                'data' => '',
            ], 200);
        }

        // $customer = Customer::where('id', $request->customer_id)->with('factory', 'country')->first();

        // $factory = Factory::where('id', $request->factory_id)->first();

        // if (!($customer && $customer->code && $factory && $factory->code && $customer->country && $customer->country->code)) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'code customer not found.',
        //     ], 200);
        // }

        // DB::table('customer_factory')->updateOrInsert([
        //     'customer_id' => $customer->id,
        //     'factory_id' => $factory->id,
        // ], []);

        // $code = $customer->country->code . '-' . $customer->code . '-' . $factory->code . '-' . date("dm", strtotime($request->date)); // . '-' . $request->extra_code;
        // $code = $this->createCode($code, $pi_id);
        
        // $existCode = Pi::where('code', $code)->where('id', '!=', $pi_id)->first();
        // if($existCode){
        //     return response()->json([
        //         'status' => 'error',
        //         'errors' => ['code' => 'PI code used, please change PI code'],
        //     ], 422);
        // }

        if($request->currency_rate > 0){
            Currency::where('id', $request->currency_id)->update(['rate'=> $request->currency_rate]);
        }

        Pi::where('id', $pi_id)->update([
            // 'code' => $code,
            'user_id' => auth()->id(),
            // 'customer_id' => $request->customer_id,
            // 'factory_id' => $request->factory_id,
            // 'date' => $request->date,
            'sale_type_id' => $request->saletype_id,
            // 'address' => $request->address,
            'delivery_location_id' => $request->delivery_location_id,
            // 'customer_name' => $customer->name,
            // 'customer_name2' => $customer->name,
            // 'number' => $request->number,
            'quantity' => $request->quantity,
            'pallet' => $request->pallet,
            'truck' => $request->truck,
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

        
        $userAccess = User::where('username', $request->user_access_username)->first();
        PiUser::create([
            'user_id' => $userAccess->id,
            'pi_id' => $pi->id,
            'sender_id' => auth()->user()->id,
            'details' => '',
        ]);
        
        Notification::create([
            'sender_id' => auth()->id(),
            'user_id' => $userAccess->id,
            'title' => 'PI was sent to you',
            'message' => "PI was sent to you. $pi->code.",
        ]);

        Notification::create([
            'sender_id' => auth()->id(),
            'user_id' => $pi->customer->user_id,
            'title' => 'update PI',
            'message' => "update PI with code: $pi->code.",
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pi created successfully.',
            'data' => $pi,
        ], 200);
    }

    public function createCode($code, $id = null)
    {
        # code...
        $piCount = Pi::where('code', 'like', "$code%")->where('id', '!=', $id)->count();
        if ($piCount) {
            $code = $code . "-" . ($piCount + 1);
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

    public function uploadFile(Request $request, $id)
    {
        # code...
        // return $request;
        $request->validate([
            'fileUpload' => 'required|file|mimes:png,jpg,gif,pdf,doc,docs,xls,xlsx',
            'title_file' => 'required',
        ]);
        $path = 'uploads/pis/';
        $pathFull = public_path($path);
        
        if (!is_dir($pathFull)) {
            mkdir($pathFull, 0777, true);
        }

        $uploadedFile = $request->file('fileUpload');
        if(!$uploadedFile){
            return response()->json([
                'status' => 'error',
                'message' => 'not file select',
            ], 200);
        }
        // $name = sha1(date('YmdHis') . Str::random(40));
        // $save_name = $name . '.' . $uploadedFile->getClientOriginalExtension();

        // $uploadedFile->move($pathFull, $save_name);
        $pathFile = Storage::put('pis', $uploadedFile);

        File::create([
            'pi_id' => $id,
            'title' => $request->title_file,
            'path' => $pathFile
        ]);

        $filesPi = File::where('pi_id', $id)->whereNull('deleted_at')->get();
        
        // return $filesPi;
        return response()->json([
            // 'message' => $save_name,
            'view' => view('pages.pis.files.files-uploaded', ['filesPi' => $filesPi])->render()
        ]);


        return $request->all();

    }

    public function downloadFile(Request $request, $id)
    {
        # code...
        $filePi = File::where('id', $id)->whereNull('deleted_at')->first();
        return Storage::download($filePi->path,  'cp-'.time().'-'.str_replace('/', '-', $filePi->path));
    }
    
    public function removeFile(Request $request, $id)
    {
        # code...
        $filePi = File::where('id', $id)->whereNull('deleted_at')->first();
        if(!$filePi){
            return response()->json([
                'status' => 'error',
                'message' => 'not exists.',
            ], 200);
        }

        $filePi->deleted_at = Carbon::now();
        $filePi->save();
        return response()->json([
            'status' => 'success',
            'message' => 'removed successfully.',
            // 'autoRedirect' => route('pages.customers.list')
        ], 200);
        return $filePi;
    }

    public function changeStatus(Request $request, $id)
    {
        # code...
        // return $request;
        $pi = Pi::find($id);
        if(!$pi){
            return response()->json([
                'status' => 'error',
                'title' => '',
                'message' => 'error.',
            ], 200);
        }
        
        $pi->actived_at = $request->status === 'true' ? Carbon::now() : null;
        $pi->save();

        return response()->json([
            'status' => 'success',
            'title' => '',
            'message' => 'changed successfuly',
        ], 200);
    }

    public function removePi(Request $request, $id)
    {
        # code...
        $pi = Pi::find($id);
        if(!$pi){
            return response()->json([
                'status' => 'error',
                'title' => '',
                'message' => 'error.',
            ], 200);
        }

        $pi->deleted_at = Carbon::now();// $request->deleted_at ? Carbon::now() : null;
        $pi->save();

        // return back();

        return response()->json([
            'status' => 'success',
            'title' => '',
            'message' => 'removed successfuly',
        ], 200);
    }
}
