@php /** @var \Domain\Shop\Models\Page $page */ @endphp

@extends('shop::layouts.master', ['layout' => $layout])

@section('heading')
  <div class="heading">
    <div class="container">
      <div class="heading-content">
        <h1 class="heading-title">
          {{ $page->title }}
        </h1>

        @if ($page->about)
          <div class="heading-body">
            {{ $page->about }}
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="page">
    <div class="container">
      <div class="page__grid">
        <div class="page__content">
          @if(View::hasSection('sub-content'))
            @yield('sub-content')
          @else
            <div class="page__typography">
              {!! $page->content !!}
            </div>
          @endif
        </div>

        <div class="page__aside">
          @include('shop::page.partials.aside')
        </div>
      </div>
    </div>
  </div>
@endsection
