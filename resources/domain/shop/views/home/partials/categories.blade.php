@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<div class="categories">
  <div class="container">
    <div class="categories__content">
      <div class="categories__main">
        <a href="{{ route('shop::catalog', ['featured' => true]) }}" class="category category--main">
          <img class="category-image" src="/images/man.png">

          <div class="category-content">
            <div class="category-label">
              Только сегодня
            </div>

            <div class="category-name">
              Акции дня
            </div>
          </div>
        </a>
      </div>

      <div class="categories__grid">
        @foreach($layout->getCategories() as $category)
          <a href="{{ route('shop::catalog', $category) }}" class="category">
            <img class="category-image" src="{{ $category->image }}" alt="{{ $category->title }}">

            <div class="category-content">
              <div class="category-label">
                {{ $category->productsCount() }} товаров
              </div>

              <div class="category-name">
                {{ $category->name }}
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>
</div>
