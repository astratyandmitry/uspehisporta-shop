<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title }} — {{ config('app.name') }}</title>
  <link href="{{ mix('/assets/cms/css/app.css') }}" rel="stylesheet">
  @include('shared.head-icons')
  @stack('styles')
</head>
<body class="preload" onload="removePreloader()">

<div id="app" class="clean">
  @yield('content')
</div>

@if (auth()->check())
  <script src="{{ mix('/assets/cms/js/app.js') }}"></script>
  @stack('scripts')
@else
  <script>
    function removePreloader () {
      document.body.className = document.body.className.replace('preload', '')
    }
  </script>
@endif

</body>
</html>
