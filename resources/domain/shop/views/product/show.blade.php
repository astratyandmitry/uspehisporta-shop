@php /** @var \Domain\Shop\Models\Product $product */ @endphp

@extends('shop::layouts.master')

@section('subtitle')
  @include('shop::product.partials.show-detail')
@endsection

@section('content')
  <div class="product-card">
    <div class="container">
      <div class="product" id="product">
        <div class="product__left">
          <div class="media">
            @if ($product->badges !== null && $badges = explode(',', $product->badges))
              <div class="media__badge">
                @foreach($badges as $badge)
                  <div class="media__badge__item">
                    {{ $badge }}
                  </div>
                @endforeach
              </div>
            @endif
            <product-gallery
              :gallery=@json($product->gallery)
              main="{{ image_url($product->image) }}"
              name="{{ $product->name }}"
            />
          </div>

          <div class="product-info product-info--desktop">
            <div class="info">
              <div class="info-body">
                <div class="info-body-title">
                  Описание
                </div>

                {!! $product->about !!}
              </div>

              @if ($product->characteristics)
                <div class="info-body">
                  <div class="info-body-title">
                    Характеристики
                  </div>

                  {!! $product->characteristics !!}
                </div>
              @endif
            </div>

            @if ($product->brand && $product->brand_id > 1)
              <div class="brand">
                @if ($product->brand->logotype)
                  <div class="brand__media">
                    <img src="{{ $product->brand->logotype }}" alt="{{ $product->brand->name }}"
                         class="brand__image">
                  </div>
                @endif

                <div class="brand__info">
                  <div class="brand__name">
                    {{ $product->brand->name }}
                  </div>

                  <div class="brand__detail">
                    Официальные поставки от бренда
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>

        <div class="product__right">
          <div class="product__config">
            <div class="price">
              @if ($product->price_sale)
                <div class="price__prev">
                  <span>{{ $product->price }}</span> ₸
                </div>

                <div class="price__value">
                  <span>{{ $product->price_sale }}</span> ₸
                </div>
              @else
                <div class="price__value">
                  <span>{{ $product->price }}</span> ₸
                </div>
              @endif

              <div class="price__notice">
                Цена актуальна только в <span class="nowrap">интернет-магазине</span>
              </div>
            </div>
          </div>

          @if ($product->quantity)
            <product-basket
              :variations='@json($product->variations)'
              :product_id="{{ $product->id }}"
              :price="{{ $product->price }}"
              :price_sale="{{ (int)$product->price_sale }}"
              :quantity="{{ $product->quantity }}"
            ></product-basket>

            <a target="_blank" href="https://wa.me/77071356969?text=Здравствуйте. Я хочу преобрести товар «{{ $product->name }}» %0a{{ $product->url() }}" class="whatsapp-order">
              Заказать через WhatsApp
            </a>
          @else
            <div class="empty empty--sm">
              <div class="empty__title">
                Остатки не найдены
              </div>

              <div class="empty__message">
                В данный момент на нашем складе нет данной продукции, попробуйте вернуться позднее...
              </div>
            </div>
          @endif
        </div>

        <div class="product-info product-info--mobile">
          <div class="info">
            <div class="info-body">
              <div class="info-body-title">
                Описание
              </div>

              {!! $product->about !!}
            </div>

            @if ($product->characteristics)
              <div class="info-body">
                <div class="info-body-title">
                  Характеристики
                </div>

                {!! $product->characteristics !!}
              </div>
            @endif
        </div>

          @if ($product->brand)
            <div class="brand">
              @if ($product->brand->logotype)
                <div class="brand__media">
                  <img src="{{ $product->brand->logotype }}" alt="{{ $product->brand->name }}"
                       class="brand__image">
                </div>
              @endif

              <div class="brand__info">
                <div class="brand__name">
                  {{ $product->brand->name }}
                </div>

                <div class="brand__detail">
                  Официальные поставки от бренда
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>

    @include('shop::product.partials.show-reviews')

    @include('shop::product.partials.show-related')

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ mix('/assets/shop/js/product.js') }}"></script>
  </div>
@endsection
