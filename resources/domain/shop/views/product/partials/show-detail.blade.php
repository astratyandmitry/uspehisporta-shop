@php /** @var \Domain\Shop\Models\Product $product */ @endphp

<div class="product-detail">
  <div class="product-detail__item">
    <a href="{{ $product->category->url() }}">{{ $product->category->name }}</a>
  </div>
  @if ($product->brand)
    <div class="product-detail__divider">&middot;</div>
    <div class="product-detail__item">
      <a href="{{ $product->category->url() }}?brand={{ $product->brand_id }}">{{ $product->brand->name }}</a>
    </div>
  @endif
  <div class="product-detail__divider">&middot;</div>
  <div class="product-detail__rating">
    @for($i = 1; $i <= 5; $i++)
      @if (round($product->rating) >= $i)
        @include('shop::layouts.partials.svg.star', ['class' => 'product-detail__rating__icon product-detail__rating__icon--fill'])
      @else
        @include('shop::layouts.partials.svg.star', ['class' => 'product-detail__rating__icon'])
      @endif
    @endfor
  </div>
</div>
