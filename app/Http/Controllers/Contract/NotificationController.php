<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->contractNotifications()->get();

        return view('contracts.notifications.index', compact('notifications'));
    }
}
