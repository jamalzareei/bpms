<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        # code...
        // return \App\Models\Notification::where('user_id', auth()->id())->whereNull('readed_at')->paginate(5);

        $customers = Customer::select('id', 'name')->with(['pis' => function ($query) {
            $query->select('id');
        }])->take(10)->get();

        $year = date('Y');
        $piInYear = Pi::whereNull('deleted_at')
            // ->whereDate()
            ->whereYear('issud_at', $year)
            ->sum(DB::raw('
                producing +
                stock +
                booking +
                trucks_factory +
                trucks_on_way +
                trucks_on_border +
                trucks_vend_on_way
            '));


        // return $piInYear;
        $monthPis = Pi::whereBetween('issud_at', [now()->subMonth(12), now()])
            ->orderBy('issud_at')
            ->select(
                    'producing' ,
                    'stock' ,
                    'booking' ,
                    'trucks_factory' ,
                    'trucks_on_way' ,
                    'trucks_on_border' ,
                    'trucks_vend_on_way'
                )
            // ->whereYear('issud_at', $year)
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->issud_at)->format('M');
            });
        // ->groupBy('id');

        // return $monthPis;

        $chartData = [];
        $chartCategory = [];
        $row = 0;
        foreach ($monthPis as $month => $appointments) {
            $chartData[$row]['name'] = $chartCategory[] = $month;
            // return $appointments;
            // echo '<h2>'.$day.'</h2><ul>';
            $sum = 0;
            foreach ($appointments as $appointment) {
                $sum +=
                    $appointment->producing +
                    $appointment->stock +
                    $appointment->booking +
                    $appointment->trucks_factory +
                    $appointment->trucks_on_way +
                    $appointment->trucks_on_border +
                    $appointment->trucks_vend_on_way;
            }
            $chartData[$row]['data'] = [$appointments->count(), $sum];
            $row++;
        }
        // return $chartData;

        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'customers' => $customers,
            'piInYear' => $piInYear,
            'monthPis' => $monthPis,
            'chartData' => $chartData,
            'chartCategory' => $chartCategory,
        ]);
    }

    public function loadPi(Request $request)
    {
        # code...
        $request->validate([
            'code' => 'required|exists:pis,code'
        ]);

        $pi = Pi::where('code', $request->code)->first();
        if (!$pi) {
            return response()->json([
                'errors' => [
                    'code' => 'PI not Found'
                ]
            ], 422);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Pi created successfully.',
            'autoRedirect' => route('pages.pi.show', ['id' => $pi->id])
        ], 200);
    }

    public function getPis(Request $request)
    {
        # code...
        $request->validate([
            'customer_id' => 'required|exists:customers,id'
        ]);

        $pisReserved = Pi::whereNull('deleted_at')
            ->where('customer_id', $request->customer_id)
            ->whereHas('customer', function ($query) {
                $query
                    ->where('producing', 0)
                    ->where('stock', 0)
                    ->where('booking', 0)
                    ->where('trucks_factory', 0)
                    ->where('trucks_on_way', 0)
                    ->where('trucks_on_border', 0)
                    ->where('trucks_vend_on_way', 0);
            })
            ->take(10)->get();

        $pisLoading = Pi::whereNull('deleted_at')
            ->where('customer_id', $request->customer_id)
            ->whereHas('customer', function ($query) {
                $query
                    ->where('trucks_factory', '>', 0);
            })
            ->take(10)->get();

        return response()->json([
            'pisReserved' => $pisReserved,
            'pisLoading' => $pisLoading,
        ], 200);
    }
}
