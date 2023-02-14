@php /** @var \Domain\Shop\Models\Category $category */ @endphp

<a href="{{ route('shop::catalog', $category) }}" class="category">
  <img src="{{ image_url($category->image) }}" alt="{{ $category->title }}" class="category__image">
</a>
