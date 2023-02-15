@php /** @var string $section */ @endphp

<header>
  <div class="container">
    <div class="brand">
      <div class="logotype">
        <span>УСПЕХИ</span>СПОРТА
      </div>
    </div>

    <ul class="menu">
      <li {{ isActive($section == 'main') }}>
        <a href="{{ route('cms::orders.index') }}">
          Основное
        </a>
      </li>
      <li {{ isActive($section == 'dictionary') }}>
        <a href="{{ route('cms::categories.index') }}">
          Справочники
        </a>
      </li>
      <li {{ isActive($section == 'system') }}>
        <a href="{{ route('cms::setting.index') }}">
          Система
        </a>
      </li>
      <li class="is-logout">
        <a href="{{ route('cms::logout') }}">
          @lang('cms.logout')
        </a>
      </li>
    </ul>
  </div>
</header>
