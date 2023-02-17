@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<footer class="footer">
  <div class="container">
    <div class="footer__grid">
      <div class="section">
        <div class="section__body">
          <ul class="menu">
            <li class="menu__item">
              <a href="{{ route('shop::page', 'about') }}" class="menu__link">
                О компании
              </a>
            </li>
            <li class="menu__item">
              <a href="{{ route('shop::page', 'cÏontacts') }}" class="menu__link">
                Контакты
              </a>
            </li>
            <li class="menu__item">
              <a href="{{ route('shop::page', 'delivery-and-payment') }}" class="menu__link">
                Доставка и оплата
              </a>
            </li>
            <li class="menu__item">
              <a href="{{ route('shop::page', 'rules') }}" class="menu__link">
                Правила использования
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="section section__contacts">
        <div class="section__body">
          <div class="contact">
            <div class="contact__label">
              Адрес
            </div>
            <div class="contact__value">
              {{ config('shop.contact.address') }}
            </div>
          </div>

          <div class="contact">
            <div class="contact__label">
              Телефон
            </div>
            <div class="contact__value">
              <a href="tel:{{ clean_phone(config('shop.contact.phone')) }}">
                {{  config('shop.contact.phone') }}
              </a>
            </div>
          </div>

          <div class="contact">
            <div class="contact__label">
              E-mail
            </div>
            <div class="contact__value">
              <a href="mailto:{{ config('shop.contact.email') }}">
                {{ config('shop.contact.email') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="copyright">
      © {{ env('APP_NAME') }} {{ date('Y') }} интернет-магазин интимных товаров
    </div>
  </div>
</footer>
