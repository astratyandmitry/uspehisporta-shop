@php /** @var \Domain\Shop\Catalog $catalog */ @endphp

@extends('shop::layouts.master')

@section('content')
  <div class="products">
    <section id="filter">
      <catalog-filter
        :total="{{ $catalog->total }}"
        :categories="{{ json_encode($catalog->categories) }}"
        :brands="{{ json_encode($catalog->brands) }}"
        :sorting="{{ json_encode($catalog->sortingOptions) }}"
        :price-min="{{ $catalog->priceMin }}"
        :price-max="{{ $catalog->priceMax }}"
        :input-category="{{ json_encode($catalog->categoriesQuery) }}"
        :input-brand="{{ json_encode($catalog->brandsQuery) }}"
        :input-price-from="{{ $catalog->priceFrom }}"
        :input-price-to="{{ $catalog->priceTo }}"
        input-sorting="{{ $catalog->sorting }}"
        :input-discount="{{ $catalog->saleOnly ? 'true' : 'false' }}"
        reset-url="{{ $catalog->resetUrl() }}"
        sorting-url="{{ $catalog->sortingUrl() }}"
      ></catalog-filter>
    </section>

    <div class="container">
      @if (count($catalog->products))
        <div class="products__list">
          @each('shop::product.partials.item', $catalog->products, 'product')
        </div>

        {{ $catalog->products->links() }}
      @else
        @include('shop::layouts.partials.empty', [
            'title' => 'Товары не найдены',
            'about' => 'Не удалось найти доступные товары по вашем запросу',
        ])
      @endif
    </div>
  </div>

  <script src="{{ mix('/assets/shop/js/filter.js') }}"></script>
@endsection
