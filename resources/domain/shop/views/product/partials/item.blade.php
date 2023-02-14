@php /** @var \Domain\Shop\Models\Product $product */ @endphp

<a href="{{ $product->url() }}" class="product-item">
  <div class="product__media">
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
  </div>

  <div class="product__content">
    <div class="product__info">
      <div class="product__price">
        {{ price($product->price_sale ? (int)$product->price_sale : (int)$product->price) }} ₸
      </div>

      @if ($product->price_sale)
        <div class="product__sale">
          {{ price($product->price) }} ₸
        </div>
      @endif
    </div>

    <div class="product__main">
      <div class="product__name">
        {{ $product->name }}
      </div>

      @if ($product->brand || $product->category)
        <div class="product__detail">
          {{ $product->brand ? $product->brand->name : $product->category->name }}
        </div>
      @endif

      <div class="product__rating">
        @for($i = 1; $i <= 5; $i++)
          @if (round($product->rating) >= $i)
            @include('shop::layouts.partials.svg.star', ['class' => 'product__rating__icon product__rating__icon--fill'])
          @else
            @include('shop::layouts.partials.svg.star', ['class' => 'product__rating__icon'])
          @endif
        @endfor
      </div>
    </div>
  </div>
</a>
