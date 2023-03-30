@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<footer class="footer">
  <div class="container">
    <div class="footer__content">
      <div class="footer__left">
        <div class="footer-section">
          <div class="footer-section__title">
            Навигация
          </div>

          <div class="footer-section__content">
            <ul class="menu">
              <li class="menu-item">
                <a href="{{ route('shop::home', 'about') }}" class="menu-link">
                  <span>Главная</span>
                </a>
              </li>
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
          </div>
        </div>

        <div class="footer-section">
          <div class="footer-section__title">
            Продукция
          </div>

          <div class="footer-section__content">
            <ul class="menu">
              @foreach($layout->getCategories() as $category)
                <li class="menu-item">
                  <a href="{{ route('shop::catalog', $category) }}" class="menu-link">
                    <span>{{ $category->name }}</span>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>

      <div class="footer__right">
        <div class="footer-section">
          <div class="footer-section__title">
            Информация
          </div>

          <div class="footer-section__content">
            <div class="footer__copyright">
              Приглашаем клиентов воспользоваться услугами нашего магазина «Успехи спорта». Мы обеспечиваем своих
              покупателей лучшими условиями, соответствующими приобретению гормонов роста. Также вы можете познакомиться
              с фото анализов представленной продукции, прикрепленных в галерее. Мы гарантируем оперативную доставку,
              лучшую цену продукта, а также обеспечиваем высококачественной спортивной фармакологией в ассортименте,
              произведенной на проверенных зарубежных и отечественных производствах.
            </div>
          </div>

          <div class="buttons">
            <a class="i-button i-button--inverse i-button--icon i-button--fill" target="_blank"
               href="{{ $layout->getSettings(SETTINGS_URL_TELEGRAM_OPERATOR) }}">
              <span>Оператор</span>
              @include('shop::layouts.partials.svg.telegram', ['class' => 'i-button__icon'])
            </a>

            <a class="i-button i-button--inverse i-button--icon" target="_blank"
               href="{{ $layout->getSettings(SETTINGS_URL_TELEGRAM_CONSULTING) }}">
              <span>Констультация</span>
              @include('shop::layouts.partials.svg.telegram', ['class' => 'i-button__icon'])
            </a>

            <a class="i-button i-button--inverse i-button--circle" target="_blank"
               href="{{ $layout->getSettings(SETTINGS_URL_FORUM_DO4A) }}">
              <img src="/images/icons/do4a.svg" alt="Do4a">
            </a>

            <a class="i-button i-button--inverse i-button--circle" target="_blank"
               href="{{ $layout->getSettings(SETTINGS_URL_FORUM_ANABOLICS) }}">
              <img src="/images/icons/anabolycs.svg" alt="Anabolycs">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
