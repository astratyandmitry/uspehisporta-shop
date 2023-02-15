@php /** @var \Domain\Shop\Models\Faq[]|\Illuminate\Database\Eloquent\Collection $mainBanners */ @endphp

@if ($mainBanners->isNotEmpty())
    <div class="container">
        <div class="slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($mainBanners as $mainBanner)
                        <a href="{{ $mainBanner->url }}" target="_blank" class="swiper-slide slide">
                            <img src="{{ image_url($mainBanner->image) }}" alt="{{ $mainBanner->title }}"
                                 class="slide__image">
                            <img src="{{ image_url($mainBanner->image_mobile) }}" alt="{{ $mainBanner->title }}"
                                 class="slide__image slide__image--mobile">
                        </a>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            var mySwiper = new Swiper('.swiper-container', {
                direction: 'horizontal',
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                scrollbar: {
                    el: '.swiper-scrollbar',
                },
            })
        </script>
    @endpush
@endif
