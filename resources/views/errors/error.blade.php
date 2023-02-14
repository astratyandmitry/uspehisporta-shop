<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $code }} — {{ $message }}</title>
  <link rel="stylesheet" href="{{ mix('/assets/shop/css/error.css') }}">
  @include('shared.head-icons')
</head>
<body>

<div class="error-page">
  <div class="content">
    <div class="error">
      <div class="error__code">
        {{ $code }}
      </div>

      <div class="error__message">
        {{ $message }}
      </div>
    </div>

    <a href="{{ $url }}" class="button">
      {{ $action }}
    </a>
  </div>
</div>

</body>
</html>
