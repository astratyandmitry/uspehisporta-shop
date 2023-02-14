@php /** @var \Domain\Shop\Models\Category[] $categories */ @endphp
@php /** @var \Domain\Shop\Models\Product[]|\Illuminate\Database\Eloquent\Collection $latestProducts */ @endphp
@php /** @var \Domain\Shop\Models\Product[]|\Illuminate\Database\Eloquent\Collection $popularProducts */ @endphp
@php /** @var \Domain\Shop\Models\Product[]|\Illuminate\Database\Eloquent\Collection $featuredProducts */ @endphp

@extends('shop::layouts.master')

@section('content')
  <div class="home">

    @include('shop::home.partials.banners')

    @include('shop::home.partials.categories')

    @if ($featuredProducts->isNotEmpty())
      @include('shop::home.partials.products', [
          'title' => 'Рекомендованные товары',
          'products' => $featuredProducts,
      ])

      @include('shop::home.partials.banners-split')
    @endif

    @include('shop::home.partials.products', [
        'title' => 'Популярные товары',
        'products' => $popularProducts,
    ])

    @include('shop::home.partials.banners-split')

    @include('shop::home.partials.products', [
        'title' => 'Новые товары',
        'products' => $latestProducts,
    ])
  </div>
@endsection
