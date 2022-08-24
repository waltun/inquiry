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

    public function markAllAsRead(Request $request)
    {
        $notifications = auth()->user()->unreadNotifications()->get();

        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }

        alert()->success('خوانده شده', 'اعلان های مورد نظر با موفقیت به خوانده شده تغییر کرد');

        return back();
    }

    public function destroyAll(Request $request)
    {
        $notifications = auth()->user()->notifications()->where('read_at', '!=', null)->get();

        foreach ($notifications as $notification) {
            $notification->delete();
        }

        alert()->success('حذف اعلان ها', 'اعلان های مورد نظر با موفقیت حذف شدند');

        return back();
    }
}
