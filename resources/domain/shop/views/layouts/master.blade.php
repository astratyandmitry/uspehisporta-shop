@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp
  <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@if ($title = $layout->title)
      {{ $title }} —
    @endif{{ env('APP_NAME') }}</title>
  <link rel="stylesheet" href="{{ mix('/assets/shop/css/app.css') }}">
  <meta property="og:image" content="{{ url('/images/social.png') }}" />
  @include('shared.head-icons')
  @stack('styles')
</head>
<body class="preload">

<section id="shop" class="app">
  @include('shop::layouts.partials.nav')

  @include('shop::layouts.partials.header')

  <main class="main">
    @yield('heading')

    <div class="main__content">
      @yield('content')
    </div>
  </main>

  @include('shop::layouts.partials.footer')

  <div class="loader"></div>
</section>


<script src="{{ mix('/assets/shop/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
