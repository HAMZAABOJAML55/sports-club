<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the notifications.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $notifications = Notification::all();

        return response()->json([
            'notifications' => $notifications,
        ]);
    }

    /**
     * Display the specified notification.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($notification)
    {
        $notify=Notification::find($notification);
        if (!$notify){
            return response()->json([
                'message' => "not found",
            ],404);
        }
        return response()->json([
            'notification' => $notification,
        ]);
    }

    // Add other methods for create, update, and delete if required
}
