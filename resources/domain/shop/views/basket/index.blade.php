@php /** @var \Domain\Shop\Models\Basket[] $baskets */ @endphp
@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

@extends('shop::layouts.master', ['layout' => $layout])

@section('heading')
  <div class="heading">
    <div class="container">
      <div class="heading-content">
        <h1 class="heading-title">
          Моя <span>корзина</span>
        </h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="basket page" id="basket">
    <div class="container">
      @if (count($baskets))
          <basket :data='@json($baskets)' :delivery-price="{{ config('shop.delivery_price') }}">
            <template v-slot>
              @include('shop::layouts.partials.empty', [
                  'title' => 'Товары не найдены',
                  'about' => 'Ранее вы не добавили ни одного товара в корзину',
              ])
            </template>
          </basket>
      @else
        @include('shop::layouts.partials.empty', [
            'title' => 'Товары не найдены',
            'about' => 'Ранее вы не добавили ни одного товара в корзину',
        ])
      @endif
    </div>
  </div>

  <script src="{{ mix('/assets/shop/js/basket.js') }}"></script>
@endsection
