<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Contract $contract)
    {
        $notifications = $contract->contractNotifications()->get();

        foreach ($notifications as $notification) {
            if (is_null($notification->read_at)) {
                $notification->read_at = now();
                $notification->save();
            }
        }

        return view('contracts.notifications.index', compact('notifications', 'contract'));
    }

    public function markAsDone(Contract $contract, ContractNotification $notification)
    {
        $notification->done_at = now();
        $notification->save();

        alert()->success('اتمام موفق', 'اطلاعیه با موفقیت اتمام شد');

        return back();
    }
}
