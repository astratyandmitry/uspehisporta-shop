<?php

namespace Domain\Shop\Mails;

use Domain\Shop\Models\Order;
use Illuminate\Mail\Mailable;

class OrderMail extends Mailable
{
    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build(): OrderMail
    {
        return $this
            ->subject(env('APP_NAME').": Подтверждение заказа №{$this->order->id}")
            ->markdown('shop::mails.order');
    }
}
