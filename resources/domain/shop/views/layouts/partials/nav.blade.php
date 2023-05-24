@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<nav id="nav">
  <div class="container">
    <div class="nav__content">
      <ul class="menu">
        <li class="menu-item">
          <a href="{{ route('shop::page', 'about') }}" class="menu-link">
            <span>О компании</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('shop::page', 'payment-and-delivery') }}" class="menu-link">
            <span>Оплата и доставка</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('shop::page', 'faq') }}" class="menu-link">
            <span>Вопросы и ответы</span>
          </a>
        </li>
      </ul>

      <ul class="menu">
        <li class="menu-item">
          <a href="{{ $layout->getSettings(SETTINGS_URL_TELEGRAM_PRICE) }}" class="menu-link menu-link--icon" target="_blank">
            <span>Прайс-лист</span>
            @include('shop::layouts.partials.svg.telegram', ['class' => 'menu-item__icon'])
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ $layout->getSettings(SETTINGS_URL_TELEGRAM_GROUP) }}" class="menu-link menu-link--icon" target="_blank">
            <span>Отзывы магазина</span>
            @include('shop::layouts.partials.svg.telegram', ['class' => 'menu-item__icon'])
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
