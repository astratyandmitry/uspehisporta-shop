@php /** @var string $section */ @endphp
@php /** @var string $model */ @endphp

<nav>
  <div class="container">
    @switch($section)
      @case('main')
      <ul class="menu">
        <li {{ isActive($model == 'orders') }}>
          <a href="{{ route('cms::orders.index') }}">
            @lang('cms.model.orders')
          </a>
        </li>
        <li {{ isActive($model == 'reviews') }}>
          <a href="{{ route('cms::reviews.index') }}">
            @lang('cms.model.reviews')
          </a>
        </li>
        <li {{ isActive($model == 'products') }}>
          <a href="{{ route('cms::products.index') }}">
            @lang('cms.model.products')
          </a>
        </li>
        <li class="is-divider">
          <span>&middot;</span>
        </li>
        <li {{ isActive($model == 'banners') }}>
          <a href="{{ route('cms::banners.index') }}">
            @lang('cms.model.banners')
          </a>
        </li>
        <li {{ isActive($model == 'pages') }}>
          <a href="{{ route('cms::pages.index') }}">
            @lang('cms.model.pages')
          </a>
        </li>
      </ul>
      @break
      @case('dictionary')
      <ul class="menu">
        <li {{ isActive($model == 'categories') }}>
          <a href="{{ route('cms::categories.index') }}">
            @lang('cms.model.categories')
          </a>
        </li>
        <li {{ isActive($model == 'brands') }}>
          <a href="{{ route('cms::brands.index') }}">
            @lang('cms.model.brands')
          </a>
        </li>
      </ul>
      @break
      @case('system')
      <ul class="menu">
        <li {{ isActive($model == 'managers') }}>
          <a href="{{ route('cms::managers.index') }}">
            @lang('cms.model.managers')
          </a>
        </li>
      </ul>
      @break
    @endswitch
  </div>
</nav>
