<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Config;
class SendMailCart extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $orderDetail)
    {

        $this->customer = $customer;
        $this->orderDetail = $orderDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dataOrder = [];
        $dataOrder [] = $this->orderDetail;
        \Log::info("Send mail cart to customer id: ".$this->customer->id);
        return $this->to($this->customer->email)
        ->from(Config::get('mail.from.address'), __("KuteShop"))
        ->subject(__("Thông tin đơn hàng"))
        ->view('frontend.email')
        ->with([
            'customer' => $this->customer,
            'orderDetail' => $dataOrder
        ]);
    }
}
