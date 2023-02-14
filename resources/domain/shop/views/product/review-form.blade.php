@php /** @var \Domain\Shop\Models\Product $product */ @endphp

@extends('shop::layouts.master')

@section('content')
  <div class="product-review">
    <div class="container">
      <div class="product-review__grid">
        <form method="post" class="product-review__form form">
          @csrf

          <div class="message">
            Ваш отзыв появиться на сайте после проверки модератором
          </div>


          <div class="form-grid">
            @include('shop::layouts.includes.form.field.input', [
                'attribute' => 'username',
                'placeholder' => 'Представьтесь',
                'required' => true,
                'autofocus' => true,
            ])

            @include('shop::layouts.includes.form.field.dropdown', [
                'attribute' => 'rating',
                'placeholder' => 'Оценка',
                'required' => true,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5],
            ])
          </div>

          @include('shop::layouts.includes.form.field.textarea', [
              'attribute' => 'message',
              'placeholder' => 'Ваш комментарий',
              'required' => true,
              'rows' => 5,
          ])

          <button type="submit" class="form-button">
            Оставить отзыв
          </button>
        </form>

        <div>
          @include('shop::product.partials.item')
        </div>
      </div>
    </div>
  </div>
@endsection
