<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title }} — {{ config('app.name') }}</title>
  <link href="{{ mix('/assets/cms/css/app.css') }}" rel="stylesheet">
  @include('shared.head-icons')
  @stack('styles')
</head>
<body class="preload">

<div id="app">
  <div class="background"></div>

  @include('cms::layouts.partials.header')

  @include('cms::layouts.partials.nav')

  <section class="heading container">
    <div class="heading-title">
      <h1>{{ $title }}</h1>
    </div>

    <div class="heading-action">
      @if (isset($create_url))
        <a href="{{ $create_url }}" class="btn btn--outlined">
          @lang('cms.action.create')
        </a>
      @endif

      @if (request()->route()->getActionMethod() == 'index')
        @if (isset($export_url))
          <a href="{{ $export_url }}?{{ http_build_query(getNotEmptyQueryParameters()) }}" target="_blank"
             class="btn btn--outlined">
            @lang('cms.action.export')
          </a>
        @endif
      @endif
    </div>
  </section>

  <section class="module @yield('module')">
    <div class="container">
      @include('cms::layouts.partials.message')

      @yield('content')
    </div>
  </section>

  @include('cms::layouts.partials.footer')
</div>



<script src="{{ mix('/assets/cms/js/app.js') }}"></script>
@if (isset($form_page) && $form_page === true)
  <script src="{{ mix('/assets/cms/js/libs/onleave.js') }}"></script>
  <script src="{{ mix('/assets/cms/js/libs/fixable.js') }}"></script>
@endif
@stack('scripts')

</body>
</html>
