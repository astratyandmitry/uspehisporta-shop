@php /** @var \Domain\Shop\Models\Product $product */ @endphp

@extends('shop::layouts.master')

@section('subtitle')
  @include('shop::product.partials.show-detail')
@endsection

@section('content')
  <div class="product-card">
    <div class="product" id="product">
      <div class="container">
        <div class="product__grid">
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
          </div>

          <div class="product__right">
            <div class="product__config">
              <h1 class="title">
                {{ $product->name }}
              </h1>

              <div class="price">
                @if ($product->price_sale)
                  <div class="price__value">
                    <span>{{ $product->price_sale }}</span> ₸
                  </div>

                  <div class="price__prev">
                    <span>{{ $product->price }}</span> ₸
                  </div>
                @else
                  <div class="price__value">
                    <span>{{ $product->price }}</span> ₸
                  </div>
                @endif
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

            <div class="product-info product-info--desktop">
              <div class="info">
                <div class="info-body">
                  <div class="info-body-title">
                    Описание
                  </div>

                  {!! $product->about !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    @include('shop::product.partials.show-reviews')

    @include('shop::product.partials.show-related')

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ mix('/assets/shop/js/product.js') }}"></script>
  </div>
@endsection
