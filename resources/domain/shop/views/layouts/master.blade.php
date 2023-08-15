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
<body class="preload" tabindex="0">

@include('shop::layouts.partials.chat-modal')

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

<script id="chatBroEmbedCode">/* Chatbro Widget Embed Code Start */
    function ChatbroLoader(chats, async) {
        async = !1 !== async;
        var params = {
            embedChatsParameters: chats instanceof Array ? chats : [chats],
            lang: navigator.language || navigator.userLanguage,
            needLoadCode: 'undefined' == typeof Chatbro,
            embedParamsVersion: localStorage.embedParamsVersion,
            chatbroScriptVersion: localStorage.chatbroScriptVersion
        }, xhr = new XMLHttpRequest;
        xhr.withCredentials = !0, xhr.onload = function () {
            eval(xhr.responseText)
        }, xhr.onerror = function () {
            console.error('Chatbro loading error')
        }, xhr.open('GET', 'https://www.chatbro.com/embed.js?' + btoa(unescape(encodeURIComponent(JSON.stringify(params)))), async), xhr.send()
    }/* Chatbro Widget Embed Code End */
    ChatbroLoader({encodedChatId: '08wBX'});</script>
<script src="{{ mix('/assets/shop/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
