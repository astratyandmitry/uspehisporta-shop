@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

@if ($layout->withBreadcrumbs || $layout->withTitle)
  <div class="heading @if (request()->routeIs('shop::order')) heading--center @endif">
    <div class="container">
      @if ($layout->withBreadcrumbs)
        @include('shop::layouts.partials.heading.breadcrumbs')
      @endif

      @if ($layout->withTitle)
        @include('shop::layouts.partials.heading.title')
      @endif

      @yield('subtitle')
    </div>
  </div>
@endif
