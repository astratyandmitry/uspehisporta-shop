@php /** @var \Domain\Shop\Models\Product $product */ @endphp

<div class="reviews" id="reviews">
  <div class="container">
    <div class="reviews__heading">
      <h3 class="reviews__title">
        Отзывы о товаре
      </h3>

      <a href="{{ route('shop::product.review', $product) }}" class="reviews__button">Написать<span> отзыв</span></a>
    </div>

    <div class="related__content products">
      @if ($message = session()->get('message'))
        <div class="message">
          {{ $message }}
        </div>
      @endif

      @if ($product->reviews->isNotEmpty())
        <div class="reviews__list">
          @each('shop::product.partials.reviews.item', $product->reviews, 'review')
        </div>
      @else
        @include('shop::layouts.partials.empty', [
            'title' => 'Отзывы не найдены',
            'about' => 'Ранее ни один из покупателей не оставил отзыва к данному товару, станьте первым!',
            'buttonUrl' => route('shop::product.review', $product),
            'buttonLabel' => 'Написать отзыв',
        ])
      @endif
    </div>
  </div>
</div>
