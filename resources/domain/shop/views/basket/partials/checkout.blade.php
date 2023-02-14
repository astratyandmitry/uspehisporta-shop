@php /** @var \Domain\Shop\Models\Order $order_prev */ @endphp

<div class="checkout">
  <div class="heading heading--spaced">
    <div class="container">
      @include('shop::layouts.partials.heading.title', ['title' => 'Оформление заказа'])
    </div>
  </div>

  <form method="post" action="{{ route('shop::checkout') }}">
    @csrf

    @include('shop::layouts.includes.form.field.input', [
        'value' => optional($order_prev)->client_name ?? optional(auth(SHOP_GUARD)->user())->name,
        'attribute' => 'name',
        'placeholder' => 'ФИО',
        'required' => true,
    ])

    @include('shop::layouts.includes.form.field.input', [
        'value' => optional($order_prev)->client_phone ?? optional(auth(SHOP_GUARD)->user())->phone,
        'attribute' => 'phone',
        'placeholder' => 'Телефон',
        'required' => true,
    ])

    @include('shop::layouts.includes.form.field.input', [
        'value' => optional($order_prev)->client_email ??  optional(auth(SHOP_GUARD)->user())->email,
        'attribute' => 'email',
        'placeholder' => 'E-mail',
        'required' => true,
        'type' => 'email',
    ])

    @include('shop::layouts.includes.form.field.textarea', [
        'value' => optional($order_prev)->delivery_address,
        'attribute' => 'address',
        'placeholder' => 'Адрес доставки',
        'required' => true,
        'rows' => 2,
    ])

    @include('shop::layouts.includes.form.field.textarea', [
        'attribute' => 'comment',
        'placeholder' => 'Комментарий',
        'rows' => 3,
    ])

    <button type="submit" class="form-button form-button--full form-button--checkout">
      Оформить заказ
    </button>

    <div class="info">
      После оформления заказа с вами свяжется наш менеджер для уточнения адреса доставки и проведение оплаты через Kaspi
    </div>
  </form>
</div>
