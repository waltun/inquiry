<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CorrectionInquiryNotification extends Notification
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
            'message' => 'یک استعلام برای اصلاح (بازبینی) ارسال شده است'
        ];
    }
}
