<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->unreadNotifications()->where('id', $id)->first();
        $notification->markAsRead();

        alert()->success('خوانده شده', 'اعلان مورد نظر با موفقیت به خوانده شده تغییر کرد');

        return back();
    }

    public function read()
    {
        $notifications = auth()->user()->notifications()->where('read_at', '!=', null)->paginate(20);
        return view('notifications.read', compact('notifications'));
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        $notification->delete();

        alert()->success('خوانده شده', 'اعلان مورد نظر با موفقیت به خوانده شده تغییر کرد');

        return back();
    }
}
