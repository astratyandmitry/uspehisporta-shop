@php /** @var \Domain\Shop\Models\Product $product */ @endphp

<div class="product-item">
  <a href="{{ $product->url() }}" class="product__media">
    @if ($product->badges !== null && $badges = explode(',', $product->badges))
      <div class="product__badge">
        @foreach($badges as $badge)
          <div class="product__badge__item">
            {{ $badge }}
          </div>
        @endforeach
      </div>
    @endif

    <img src="{{ image_url($product->image) }}" alt="{{ $product->name }}" class="product__image">
  </a>

  <div class="product__content">
    <div class="product__info">
      <div class="product__price">
        ₽{{ price($product->price_sale ? (int)$product->price_sale : (int)$product->price) }}
      </div>

      @if ($product->price_sale)
        <div class="product__sale">
          ₽{{ price($product->price) }}
        </div>
      @endif
    </div>

    <div class="product__main">
      <a href="{{ $product->url() }}" class="product__name">
        {{ $product->name }}
      </a>
    </div>

    <product-item-basket :product_id="{{ $product->id }}"></product-item-basket>
  </div>
</div>
