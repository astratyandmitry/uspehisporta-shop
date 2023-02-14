@php /** @var \Domain\Shop\Models\Review $review */ @endphp

<div class="review">
  <div class="review__heading">
    <div class="review__about">
      <div class="review__name">
        {{ $review->username }}
      </div>

      <div class="review__date">
        {{ $review->created_at->format('d.m.Y H:i') }}
      </div>
    </div>

    <div class="review__rating">
      @for($i = 1; $i <= 5; $i++)
        @if (round($review->rating) >= $i)
          @include('shop::layouts.partials.svg.star', ['class' => 'review__rating__icon review__rating__icon--fill'])
        @else
          @include('shop::layouts.partials.svg.star', ['class' => 'review__rating__icon'])
        @endif
      @endfor
    </div>
  </div>

  <div class="review__message">
    {!! nl2br($review->message) !!}
  </div>
</div>
