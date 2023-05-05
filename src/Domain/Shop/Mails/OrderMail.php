<?php

namespace Domain\Shop\Mails;

use Domain\Shop\Models\Order;
use Domain\Shop\Models\Settings;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Arr;

class OrderMail extends Mailable
{
    public Order $order;

    public string $operator;

    public function __construct(Order $order)
    {
        $this->order = $order;

        $operatorURL = Settings::query()->where('key', 'url.telegram.operator')->value('value');
        $this->operator = Arr::last(explode('/', $operatorURL));
    }

    public function build(): OrderMail
    {
        return $this
            ->subject(env('APP_NAME').": Подтверждение заказа №{$this->order->id}")
            ->markdown('shop::mails.order');
    }
}
