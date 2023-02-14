<?php

namespace Domain\Shop\Mails;

use Domain\Shop\Models\Order;
use Illuminate\Mail\Mailable;

class OrderMail extends Mailable
{
    /**
     * @var \Domain\Shop\Models\Order
     */
    public $order;

    /**
     * @param \Domain\Shop\Models\Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return \Domain\Shop\Mails\OrderMail
     */
    public function build(): OrderMail
    {
        return $this
            ->subject(env('APP_NAME').": Подтверждение заказа №{$this->order->id}")
            ->markdown('shop::mails.order');
    }
}
