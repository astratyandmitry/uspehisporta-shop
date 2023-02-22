@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

@extends('shop::page.show')

@section('sub-content')
  @include('shop::layouts.includes.boxes', [
    'title' => 'Способы <span>оплаты</span>',
    'items' => $layout->getOptionsPayment(),
  ])

  <br><br>

  @include('shop::layouts.includes.boxes', [
    'title' => 'Варианты <span>доставки</span>',
    'items' => $layout->getOptionsDelivery(),
  ])
@endsection
