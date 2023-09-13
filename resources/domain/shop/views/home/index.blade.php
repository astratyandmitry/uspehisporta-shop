@php /** @var \Domain\Shop\Models\Category[] $categories */ @endphp
@php /** @var \Domain\Shop\Models\Product[]|\Illuminate\Database\Eloquent\Collection $latestProducts */ @endphp
@php /** @var \Domain\Shop\Models\Product[]|\Illuminate\Database\Eloquent\Collection $popularProducts */ @endphp
@php /** @var \Domain\Shop\Models\Product[]|\Illuminate\Database\Eloquent\Collection $featuredProducts */ @endphp

@extends('shop::layouts.master')

@section('content')
  <div class="home">
    @include('shop::home.partials.banners')

    @include('shop::home.partials.categories')

    <div class="home-main">
      <div class="container">
        <div class="home-main__grid">
          @include('shop::layouts.includes.boxes', [
            'title' => 'Способы <span>оплаты</span>',
            'items' => $layout->getOptionsPayment(),
          ])

          @include('shop::layouts.includes.boxes', [
            'title' => 'Варианты <span>доставки</span>',
            'items' => $layout->getOptionsDelivery(),
            'home' => true,
          ])
        </div>
      </div>
    </div>

    @include('shop::home.partials.testimonials')
  </div>
@endsection
