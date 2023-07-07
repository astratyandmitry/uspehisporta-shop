@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<header class="header">
  <div class="container">
    <div class="header__content">
      <div class="header__left">
        <div class="logotype">
          <a href="{{ route('shop::home') }}">
            <img src="/images/logotype.svg" alt="{{ env('APP_NAME') }}">
          </a>
        </div>

        <a href="{{ route('shop::basket') }}" class="header-basket">
          @include('shop::layouts.partials.svg.basket', ['class' => 'header-basket__icon'])

          <span class="header-basket__info">
            <span class="header-basket__label">Корзина</span>
            <span class="header-basket__value">₽{{ number_format(app('basket')->total()) }}</span>
          </span>
        </a>
      </div>

      <div class="header__hamburger">
        @include('shop::layouts.partials.svg.menu', ['class' => 'header__hamburger-icon'])
      </div>

      <div class="header__right">
        <div class="forums">
          Наши ветки на форумах <br> Do4a и ANABOLICSHOP
        </div>

        <div class="buttons">
          <a class="i-button i-button--circle" target="_blank" href="{{ $layout->getSettings(SETTINGS_URL_FORUM_DO4A) }}">
            <img src="/images/icons/do4a.svg" alt="Do4a">
          </a>

          <a class="i-button i-button--circle" target="_blank" href="{{ $layout->getSettings(SETTINGS_URL_FORUM_ANABOLICS) }}">
            <img src="/images/icons/anabolycs.svg" alt="Anabolycs">
          </a>

          <a class="i-button i-button--icon hide-mobile" target="_blank" href="{{ $layout->getSettings(SETTINGS_URL_TELEGRAM_CONSULTING) }}">
            <span>Констультация</span>
            @include('shop::layouts.partials.svg.telegram', ['class' => 'i-button__icon'])
          </a>

          <a class="i-button i-button--icon i-button--fill" target="_blank" href="{{ $layout->getSettings(SETTINGS_URL_TELEGRAM_OPERATOR) }}">
            <span>Оператор</span>
            @include('shop::layouts.partials.svg.telegram', ['class' => 'i-button__icon'])
          </a>
        </div>
      </div>
    </div>
  </div>
</header>

<script>
document.getElementById('hamburger').addEventListener('click', function () {
  document.getElementById('nav').classList.toggle('is-active')
})
</script>
