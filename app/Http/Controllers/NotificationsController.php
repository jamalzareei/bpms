<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    //
    public function changeStatus(Request $request, $id)
    {
        # code...
        // return $request;
        $Notification = Notification::find($id);
        if(!$Notification){
            return response()->json([
                'status' => 'error',
                'title' => '',
                'message' => 'error.',
            ], 200);
        }
        
        $Notification->readed_at = $request->status === 'true' ? Carbon::now() : null;
        $Notification->save();

        return response()->json([
            'status' => 'success',
            'title' => '',
            'message' => 'changed successfuly',
        ], 200);
    }
}
