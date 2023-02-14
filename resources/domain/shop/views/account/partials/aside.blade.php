@php
  $menu = [
      'account.orders.current' => 'Текущие заказы',
      'account.orders.history' => 'История заказов',
      null,
      'account.settings.personal' => 'Настройки аккаунта',
      'account.settings.security' => 'Смена пароля',
      null,
      'auth.logout' => 'Выход',
  ];
@endphp

<div class="page-nav">
  <ul class="page-nav__list">
{{--    <li--}}
{{--      class="page-nav__item">--}}
{{--      <span class="page-nav__label">{{ auth()->user()->name }}</span>--}}
{{--    </li>--}}
    @foreach($menu as $route => $label)
      @if ($label === null)
        <li class="page-nav__divider"></li>
      @else
        <li
          class="page-nav__item {{ apply_class_when('page-nav__item--active', request()->routeIs("shop::{$route}")) }}">
          <a href="{{ route("shop::{$route}") }}" class="page-nav__link">
            {{ $label }}
          </a>
        </li>
      @endif
    @endforeach
  </ul>
</div>
