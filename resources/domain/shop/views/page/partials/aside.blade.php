@php $menuPages = \Domain\Shop\Models\Page::query()->where('system', false)->get() @endphp

<div class="page-nav">
  <ul class="page-nav__list">
    @foreach($menuPages as $menuPage)
      @continue(in_array($menuPage->hru, ['policy']))
      <li class="page-nav__item {{ apply_class_when('page-nav__item--active', $page->id === $menuPage->id) }}">
        <a href="{{ $menuPage->url() }}" class="page-nav__link">
          {{ $menuPage->name }}
        </a>
      </li>
    @endforeach
  </ul>
</div>
