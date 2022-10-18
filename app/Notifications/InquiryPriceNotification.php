<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InquiryPriceNotification extends Notification
{
    use Queueable;

    public function __construct($inquiryPrice)
    {
        $this->inquiryPrice = $inquiryPrice;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'inquiryPrice_id' => $this->inquiryPrice->id,
            'message' => 'شما یک درخواست بروزرسانی قیمت جدید دارید.'
        ];
    }
}
