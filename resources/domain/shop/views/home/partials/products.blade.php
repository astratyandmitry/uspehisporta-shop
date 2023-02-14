<div class="products">
  <div class="container">
    <div class="products__title">
      {{ $title }}
    </div>
    <div class="products__list">
      @each('shop::product.partials.item', $products, 'product')
    </div>
  </div>
</div>
