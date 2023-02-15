@php /** @var \Domain\Shop\Models\Faq[]|\Illuminate\Database\Eloquent\Collection $splitBanners */ @endphp

@if ($splitBanners->isNotEmpty())
    <div class="banners-split">
        <div class="container">
            <div class="banners-split__grid">
                @foreach($splitBanners as $splitBanner)
                    <a href="{{ $splitBanner->url }}" target="_blank" class="banners-split__item">
                        <img src="{{ image_url($splitBanner->image) }}" alt="{{ $splitBanner->title }}"
                             class="banners-split__image">
                        <img src="{{ image_url($splitBanner->image_mobile) }}" alt="{{ $splitBanner->title }}"
                             class="banners-split__image banners-split__image--mobile">
                    </a>
                @endforeach
            </div>
        </div>
@endif
