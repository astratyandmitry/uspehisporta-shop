@php /** @var \Domain\Shop\Models\Order $order */ @endphp

@extends('shop::layouts.master', ['layout' => $layout])

@section('content')
  <div class="page">
    <div class="container">
      <div class="page__grid">
        <div class="order-card">
          <table width="100%" cellpadding="0" cellspacing="0" class="items-table">
            <thead>
            <tr>
              <th align="left">Товар</th>
              <th nowrap width="120" align="left">Кол-во</th>
              <th nowrap width="120" align="right">Цена</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->items as $item)
              <tr>
                <td>
                  <a href="{{ $item->product->url() }}" target="_blank" class="product">
                    <div class="product__media">
                      <img src="{{ image_url($item->product->image) }}"
                           alt="{{ $item->product->name }}" class="product__image">
                    </div>

                    <div class="product__content">
                      <div class="product__name">
                        {{ $item->product->name }}
                      </div>

                        <div class="product__price">
                          ₽{{ price($item->price) }}/шт.
                        </div>
                    </div>
                  </a>
                </td>
                <td nowrap>
                  <div class="price">
                    <div class="price__value">
                      {{ $item->count }}
                    </div>
                  </div>
                </td>
                <td nowrap>
                  <div class="price">
                    <div class="price__value">
                      ₽{{ price($item->total) }}
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th align="right" colspan="2">
                <span>Сумма</span>
              </th>
              <th nowrap align="right">
                ₽{{ price($order->total) }}
              </th>
            </tr>
            <tr>
              <th align="right" colspan="2">
                <span>Итого</span>
              </th>
              <th nowrap align="right">
                ₽{{ price($order->total + $order->delivery_price) }}
              </th>
            </tr>
            </tfoot>
          </table>

          <div class="detail">
            @php $detail = [
                'client_name' => 'ФИО',
                'client_phone' => 'Телефон',
                'client_email' => 'E-mail',
                'delivery_address' => 'Адрес',
                'comment' => 'Комментарий',
            ] @endphp

            <div class="detail__content">
              @foreach($detail as $key => $label)
                @continue(empty($order->{$key}))
                <div class="section">
                  <div class="section__label">
                    <span>{{ $label }}</span>
                  </div>
                  <div class="section__content">
                    {{ $order->{$key} }}
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="page__aside">
          @include('shop::account.partials.aside')
        </div>
      </div>
    </div>
  </div>
@endsection
