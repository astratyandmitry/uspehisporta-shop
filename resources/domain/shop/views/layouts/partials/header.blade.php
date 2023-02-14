@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<div class="telegram">
  <div class="container">
    <div class="telegram-content">
      <div class="telegram-message">
        <div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd"
                  d="M9 4.5a.75.75 0 01.721.544l.813 2.846a3.75 3.75 0 002.576 2.576l2.846.813a.75.75 0 010 1.442l-2.846.813a3.75 3.75 0 00-2.576 2.576l-.813 2.846a.75.75 0 01-1.442 0l-.813-2.846a3.75 3.75 0 00-2.576-2.576l-2.846-.813a.75.75 0 010-1.442l2.846-.813A3.75 3.75 0 007.466 7.89l.813-2.846A.75.75 0 019 4.5zM18 1.5a.75.75 0 01.728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 010 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 01-1.456 0l-.258-1.036a2.625 2.625 0 00-1.91-1.91l-1.036-.258a.75.75 0 010-1.456l1.036-.258a2.625 2.625 0 001.91-1.91l.258-1.036A.75.75 0 0118 1.5zM16.5 15a.75.75 0 01.712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 010 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 01-1.422 0l-.395-1.183a1.5 1.5 0 00-.948-.948l-1.183-.395a.75.75 0 010-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0116.5 15z"
                  clip-rule="evenodd"/>
          </svg>

        </div>

        <div>
          <div class="telegram-title">
            Скидки и спец. предложения!
          </div>
          <div class="telegram-about">
            Присоеденяйтесь к нашему Telegram каналу и будьте в курсе новых поступлений, скидок и специальных
            предложений!
          </div>
        </div>
      </div>

      <a href="{{ config('shop.telegram_channel') }}" class="telegram-link" target="_blank">
        Телеграм канал
      </a>
    </div>
  </div>
</div>

<header class="header">
  <div class="container">
    <div class="header__content">
      <div class="header__main">
        <div class="logotype">
          <a href="{{ route('shop::home') }}" class="logotype__link">
            @if (request()->getHost() == 'kekstore.kz')
              <img src="/images/logotype-kek.png" srcset="/images/logotype-kek@2x.png 2x" alt="{{ env("APP_NAME") }}"
                   class="logotype__img"/>
            @else
              <img src="/images/logotype.png" srcset="/images/logotype@2x.png 2x" alt="{{ env("APP_NAME") }}"
                   class="logotype__img"/>
            @endif
          </a>
        </div>

        <div class="actions actions--mobile">
          <a href="{{ route('shop::search') }}"
             class="button button--mobile">
            @include('shop::layouts.partials.svg.search', ['class' => 'button__icon'])
            <span class="button__label">Поиск</span>
          </a>
        </div>

        <div class="nav">
          <div class="hamburger">
            @include('shop::layouts.partials.svg.menu', ['class' => 'hamburger__icon hamburger__icon--closed'])
          </div>

          <div class="dropdown">
            <ul class="menu menu--main">
              @foreach($layout->getCategories() as $_category)
                <li class="menu__item" data-for="{{ $_category->id }}">
                  <a href="{{ $_category->url() }}" class="menu__link" title="{{ $_category->title }}">
                    {{ $_category->name }}
                  </a>
                </li>
              @endforeach
            </ul>
            @foreach($layout->getCategories() as $_category)
              <ul class="menu menu--child" id="child-menu-{{ $_category->id }}" data-id="{{ $_category->id }}">
                @foreach($_category->children as $_subcategory)
                  <li class="menu__item">
                    <a href="{{ $_subcategory->url() }}" class="menu__link" title="{{ $_subcategory->title }}">
                      {{ $_subcategory->name }}
                    </a>
                  </li>
                @endforeach
              </ul>
            @endforeach
          </div>
        </div>
      </div>

      <form method="GET" action="{{ route('shop::search') }}" class="search">
        <button type="submit" class="search__button">
          @include('shop::layouts.partials.svg.search', ['class' => 'search__icon'])
        </button>

        <input type="text" placeholder="Поиск в каталоге" name="term" class="search__input"
               value="{{ request()->query('term') }}">
      </form>

      <div class="actions actions--desktop">
        <a href="{{ auth('shop')->guest() ? route('shop::auth.login') : route('shop::account.redirect') }}"
           class="button">
          @include('shop::layouts.partials.svg.user', ['class' => 'button__icon'])
          <span class="button__label">Профиль</span>
        </a>

        <a href="{{ route('shop::basket') }}" class="button">
          @include('shop::layouts.partials.svg.basket', ['class' => 'button__icon'])
          <span class="button__label">Корзина</span>
        </a>
      </div>
    </div>
  </div>
</header>
