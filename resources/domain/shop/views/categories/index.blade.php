@php /** @var \Domain\Shop\Models\Category[] $categories */ @endphp

@extends('shop::layouts.master')

@section('content')
  <div class="catalog">
    @include('shop::categories.partials.grid')
  </div>
@endsection
