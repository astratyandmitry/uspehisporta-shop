@php /** @var \Domain\Shop\Models\Product $product */ @endphp

@if (count($product->reviews))
  <div class="reviews" id="reviews">
    <div class="container">
      <div class="reviews__heading">
        <h3 class="reviews__title">
          Отзывы <span>о товаре</span>
        </h3>

        {{--      <a href="{{ route('shop::product.review', $product) }}" class="reviews__button">Написать<span> отзыв</span></a>--}}
      </div>

      <div class="related__content products">
        @if ($message = session()->get('message'))
          <div class="message">
            {{ $message }}
          </div>
        @endif

        <div class="reviews__list">
          @each('shop::product.partials.reviews.item', $product->reviews, 'review')
        </div>
      </div>
    </div>
  </div>
@endif
