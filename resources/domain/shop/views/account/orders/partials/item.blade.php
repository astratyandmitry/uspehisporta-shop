@php /** @var \Domain\Shop\Models\Order $order */ @endphp

<a href="{{ $order->url() }}" class="order">
  <div class="order__heading">
    <h2 class="order__title">
      Заказ №{{ $order->id }}
    </h2>

    <div class="order__status">
            <span class="order__badge order__badge--{{ $order->status->css_color }}">
                {{ $order->status->name }}
            </span>
    </div>
  </div>

  <div class="order__content">
    <div class="order__section">
      <h4 class="order__label">
        Сумма
      </h4>

      <div class="order__value">
        {{ price($order->total) }} ₸
      </div>
    </div>

    <div class="order__section">
      <h4 class="order__label">
        Товары
      </h4>

      <div class="order__value">
        {{ $order->items()->count() }} поз.
      </div>
    </div>

    <div class="order__section">
      <h4 class="order__label">
        Дата
      </h4>

      <div class="order__value">
        {{ $order->created_at->format('d.m.Y H:i') }}
      </div>
    </div>
  </div>
</a>
