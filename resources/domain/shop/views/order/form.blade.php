@php /** @var \Domain\Shop\Models\Basket[] $baskets */ @endphp
@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

@extends('shop::layouts.master', ['layout' => $layout])

@section('heading')
  <div class="heading">
    <div class="container">
      <div class="heading-content">
        <h1 class="heading-title">
          Оформление <span>заказа</span>
        </h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="basket page">
    <div class="container">
      <form action="{{ route('shop::checkout') }}" class="page__grid" method="POST">
        <div class="page__content">
          @csrf

          <div class="message">
            На Ваш адрес электронной почты будут высланы реквизиты по которым необходимо будет оплатить заказ <br>
            В случае, если Вы не получите письмо в течение часа ПРОВЕРЬТЕ папку СПАМ.
          </div>

          <div class="checkout">
            <div class="form-grid">
              @include('shop::layouts.includes.form.field.input', [
                'attribute' => 'first_name',
                'label' => 'Имя',
                'placeholder' => 'Иван',
                'required' => true,
              ])

              @include('shop::layouts.includes.form.field.input', [
                'attribute' => 'last_name',
                'label' => 'Фамилия',
                'placeholder' => 'Иванов',
                'required' => true,
              ])
            </div>

            <div class="form-grid">
              @include('shop::layouts.includes.form.field.input', [
                'attribute' => 'phone',
                'label' => 'Телефон',
                'helper' => '<strong>Объязательно привязка к Telegram</strong>',
                'placeholder' => '+9(999)9999999',
                'required' => true,
              ])

              @include('shop::layouts.includes.form.field.input', [
                'attribute' => 'email',
                'label' => 'E-mail',
                'placeholder' => 'ivan@mail.ru',
                'required' => true,
                'type' => 'email',
              ])
            </div>

            <div class="form-grid form-grid--3">
              @include('shop::layouts.includes.form.field.input', [
                'attribute' => 'city',
                'label' => 'Населенный пункт',
                'placeholder' => 'Москва',
                'required' => true,
              ])

              @include('shop::layouts.includes.form.field.input', [
                'attribute' => 'street',
                'label' => 'Адрес (улица, дом, квартира)',
                'placeholder' => 'ул. Ленина',
                'required' => true,
              ])

              @include('shop::layouts.includes.form.field.input', [
                'attribute' => 'postcode',
                'label' => 'Почтовый индекс',
                'placeholder' => '101000',
                'required' => true,
              ])
            </div>
          </div>
        </div>

        <div class="page__aside">
          <div class="basket-confirm">
            <div class="basket-info">
              <div class="basket-info__item">
                <div class="basket-info__content">
                  <div class="basket-info__label">
                    Товары
                  </div>
                </div>

                <div class="basket-info__value">
                  ₽{{ number_format(app('basket')->total()) }}
                </div>
              </div>

              <div class="basket-info__item">
                <div class="basket-info__content">
                  <div class="basket-info__label">
                    Доставка
                  </div>

                  <div class="basket-info__detail">
                    Первый класс почта РФ, по территории РФ
                  </div>
                </div>

                <div class="basket-info__value">
                  ₽{{ number_format(config('shop.delivery_price')) }}
                </div>
              </div>

              <div class="basket-info__item">
                <div class="basket-info__content">
                  <div class="basket-info__label">
                    Итог
                  </div>
                </div>

                <div class="basket-info__value">
                  ₽{{ number_format(app('basket')->total() + config('shop.delivery_price')) }}
                </div>
              </div>
            </div>

            <div class="basket-actions">
              <button type="submit" class="i-button i-button--full i-button--fill" type="button">
                <span>Подтвердить заказ</span>
              </button>
            </div>
          </div>
        </div>

      </form>
    </div>
  </div>

  <script src="{{ mix('/assets/shop/js/basket.js') }}"></script>
@endsection
