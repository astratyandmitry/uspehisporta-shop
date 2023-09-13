@php /** @var \Domain\Shop\Models\Banner[] $banners */ @endphp

<div class="carousel-container container">
  <div class="slick-slider">
    @foreach($banners as $banner)
      <div class="slick-slide">
        <a href="{{ $banner->url ?? '#' }}" class="banner__link" tabindex="0">
          <picture>
            <source media="(max-width: 768px)" srcset="{{ $banner->image_mobile }}">
            <img src="{{ $banner->image_desktop }}" />
          </picture>
        </a>
      </div>
    @endforeach
  </div>
</div>

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css">
@endpush

@push('scripts')
  <script
    src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script>
    $('.slick-slider').slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
      buttons: false,
    });
  </script>
@endpush
