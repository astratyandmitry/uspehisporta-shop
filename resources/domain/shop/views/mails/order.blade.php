@php /** @var \Domain\Shop\Models\Order $order */ @endphp
@php /** @var string $operator */ @endphp

@component('mail::message')
# Подтверждение заказа №{{ $order->id }}

Спасибо за заказ, для получения реквизитов оплаты вам необходимо написать нам в Telegram — [{{ '@'.$operator }}](https://t.me/{{ $operator }})

Или перейдите по ссылке в браузере [https://t.me/{{ $operator }}](https://t.me/{{ $operator }})

* **ФИО:** {{ $order->client_name }}
* **Телефон:** {{ $order->client_phone }}
* **E-mail:** {{ $order->client_email }}
* **Адрес:** {{ $order->delivery_address }}
@if ($order->promo)
* **Промо-код:** {{ $order->promo->code }} ({{ $order->promo->discount * 100 }}%)
@endif

@component('mail::table')
| Товар                       |  Кол.                               | Сумма                               |
|:--------------------------- | -----------------------------------:| -----------------------------------:|
@foreach($order->items as $item)
| {{ $item->title()}}      | {{ $item->count }} шт.     | ₽{{ price($item->total) }}   |
@endforeach
|  | Товары | **₽{{ price($order->total) }}** |
|  | Доставка | **₽{{ price($order->delivery_price) }}** |
@if ($order->discount)
|  | Скидка | **-₽{{ price($order->discount) }}** |
@endif
|  | Итого | **₽{{ price($order->total + $order->delivery_price - (int) $order->discount) }}** |
@endcomponent

@component('mail::button', ['url' => $order->detailUrl()])
  Детали заказа
@endcomponent
@endcomponent
