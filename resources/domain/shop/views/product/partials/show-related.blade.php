@php /** @var \Domain\Shop\Models\Product $product */ @endphp

@if ($product->related->isNotEmpty())
  <div class="related">
    <div class="container">
      <h3 class="related__title">
        Похожие товары
      </h3>

      <div class="related__content products">
        <div class="products__list">
          @each('shop::product.partials.item', $product->related, 'product')
        </div>
      </div>
    </div>
  </div>
@endif
