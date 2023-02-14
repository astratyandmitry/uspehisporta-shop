@php /** @var \Domain\Shop\Models\Page $page */ @endphp

@extends('shop::layouts.master', ['layout' => $layout])

@section('content')
  <div class="page">
    <div class="container">
      <div class="page__grid">
        <div class="page__content">
          {!! $page->content !!}
        </div>

        <div class="page__aside">
          @include('shop::page.partials.aside')
        </div>
      </div>
    </div>
  </div>
@endsection
