<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PercentInquiryNotification extends Notification
{
    use Queueable;

    public function __construct($inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'inquiry_id' => $this->inquiry->id,
            'message' => 'ثبت ضریب برای استعلام انجام شد و قیمت نهایی قابل مشاهده می باشد'
        ];
    }
}
