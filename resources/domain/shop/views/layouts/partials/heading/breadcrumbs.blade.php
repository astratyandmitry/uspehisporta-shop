@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

@if ($layout->hasBreadcrumbs())
  <div class="breadcrumbs">
    <ul class="breadcrumbs__list">
      <li class="breadcrumbs__item">
        <a href="{{ route('shop::home') }}" class="breadcrumbs__link">
          {{ env('APP_NAME') }}
        </a>
      </li>

      @foreach($layout->breadcrumbs as $url => $breadcrumb)
        <li class="breadcrumbs__divider">/</li>

        <li class="breadcrumbs__item">
          @if ($loop->last)
            {{ $breadcrumb }}
          @else
            <a href="{{ $url }}" class="breadcrumbs__link">
              {{ $breadcrumb }}
            </a>
          @endif
        </li>
      @endforeach
    </ul>
  </div>
@endif
