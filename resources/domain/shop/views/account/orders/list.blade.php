@php /** @var \Domain\Shop\Models\Order[] $orders */ @endphp

@extends('shop::layouts.master', ['layout' => $layout])

@section('content')
  <div class="page">
    <div class="container">
      <div class="page__grid">
        <div class="orders">
          @if (count($orders))
            <div class="orders__list">
              @each('shop::account.orders.partials.item', $orders, 'order')
            </div>

            {{ $orders->links() }}
          @else
            @include('shop::layouts.partials.empty', [
                'title' => 'Заказы не найдены',
                'about' => 'Ранее вы не совершили ни одного заказа',
            ])
          @endif
        </div>

        <div class="page__aside">
          @include('shop::account.partials.aside')
        </div>
      </div>
    </div>
  </div>
@endsection
