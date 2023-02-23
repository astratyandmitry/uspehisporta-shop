@php /** @var \Domain\Shop\Models\Testimonial[] $testimonials */ @endphp

@if(count($testimonials))
    <div class="testimonials">
      <div class="container">
        <div class="testimonials-header">
          <h3 class="testimonial-title">
            Клиентские <span>отзывы</span>
          </h3>

          <a class="i-button i-button--icon i-button--fill" target="_blank" href="{{ $layout->getSettings(SETTINGS_URL_TELEGRAM_GROUP) }}">
            <span>Канал с отзывами</span>
            @include('shop::layouts.partials.svg.telegram', ['class' => 'i-button__icon'])
          </a>
        </div>

        <div class="testimonials-list">
          @foreach($testimonials as $testimonial)
            <div class="testimonial">
              <div class="testimonial-message">
                {!! nl2br($testimonial->message) !!}
              </div>

              <a href="{{ $testimonial->url }}" target="_blank" class="testimonial-author">
                {{ "@{$testimonial->author}" }}
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </div>
@endif
