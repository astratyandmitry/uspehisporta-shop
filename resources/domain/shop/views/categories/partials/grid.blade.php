@php /** @var \Domain\Shop\Models\Category[] $categories */ @endphp

<div class="category-list">
  <div class="container">
    <div class="category-list__grid">
      @each('shop::categories.partials.item', $categories, 'category')
    </div>
  </div>
</div>
