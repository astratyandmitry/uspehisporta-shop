@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<div class="categories">
  <div class="container">
    <div class="categories__content">
      <div class="categories__main">
        <a href="{{ route('shop::catalog', ['featured' => true]) }}" class="category category--main">
          <img class="category-image" src="/images/home/sales.png">
        </a>
      </div>

      <div class="categories__grid">
        @foreach($layout->getCategories() as $category)
          <a href="{{ route('shop::catalog', $category) }}" class="category">
            <img class="category-image" src="/images/home/{{ $category->hru }}.png?2" alt="{{ $category->title }}">
          </a>
        @endforeach
      </div>
    </div>
  </div>
</div>
