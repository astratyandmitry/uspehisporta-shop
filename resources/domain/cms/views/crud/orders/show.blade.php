@php /** @var \Domain\Shop\Models\Order $model */ @endphp

@extends('cms::layouts.master', $globals)

@section('content')
  <div class="page-grid">
    <div class="page-grid__left">
      <section class="block">
        <div class="table table--card">
          <table>
            @include('cms::layouts.includes.show.detail_id')
            @if ($model->promo)
              <tr>
                <td class="cell--key">
                  Промо-код
                </td>
                <td>
                  {{ $model->promo->code }} ({{ $model->promo->discount * 100 }}%)
                </td>
              </tr>
            @endif
            <tr>
              <td class="cell--key">
                @lang('cms.field.client')
              </td>
              <td>
                {{ $model->client_name }}
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                @lang('cms.field.phone')
              </td>
              <td>
                {{ $model->client_phone }}
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                @lang('cms.field.email')
              </td>
              <td>
                {{ $model->client_email }}
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                @lang('cms.field.address')
              </td>
              <td>
                {{ $model->delivery_address }}

                @if ($model->delivery_price)
                  <div class="badge badge--sm" style="margin-left: .5rem">
                    ₽{{ number_format($model->delivery_price) }}
                  </div>
                @endif
              </td>
            </tr>
            @if ($model->comment)
              <tr>
                <td class="cell--key">
                  @lang('cms.field.comment')
                </td>
                <td>
                  {{ $model->comment }}
                </td>
              </tr>
            @endif
            <tr>
              <td class="cell--key">
                @lang('cms.field.status')
              </td>
              <td>
                <div class="badge badge--{{ $model->status->css_color }}">
                  {{ $model->status->name }}
                </div>
              </td>
            </tr>
            @include('cms::layouts.includes.show.detail_dates')
          </table>
        </div>
      </section>

      <div>
        <div class="subheading">
          <h2>Заказанные товары</h2>
        </div>

        <section class="block block--offset block--transparent">
          <div class="table is-card">
            <table>
              @php $model->load(['items', 'items.product']) @endphp
              @foreach($model->items as $item)
                <tr>
                  <td>
                    <a href="{{ $item->product->url() }}" target="_blank">
                      {{ $item->product->name }}
                    </a>

                    @if ($item->variation)
                      <br><small>{{ $item->variation }}</small>
                    @endif

                  </td>
                  <td width="60" style="text-align: right">
                    {{ $item->count }} шт.
                  </td>
                  <td width="100" style="text-align: right">
                    ₽{{ number_format($item->price) }}
                  </td>
                  <td width="120" style="text-align: right">
                    ₽{{ number_format($item->total) }}
                  </td>
                </tr>
              @endforeach
              @if ($model->delivery_price)
                <tr>
                  <td colspan="4" style="text-align: right; background: #fafafa">
                    Доставка ₽{{ number_format($model->delivery_price) }}
                  </td>
                </tr>
              @endif
              @if ($model->discount)
                <tr>
                  <td colspan="4" style="text-align: right; background: #fafafa">
                    Скидка -₽{{ number_format($model->discount) }}
                  </td>
                </tr>
              @endif
              <tr>
                <th colspan="4" style="text-align: right; font-size: 16px">
                  Итого ₽{{ number_format($model->total + $model->delivery_price - (int) $model->discount) }}
                </th>
              </tr>
            </table>
          </div>
        </section>
      </div>
    </div>

    <div class="page-grid__right">
      <div class="block aside">
        @if ($model->status_key === ORDER_STATUS_CREATED)
          <ul class="navigation">
            <li>
              <form method="post" action="{{ route("cms::orders.complete", $model->id) }}">
                @csrf

                <a href="javascript:void(0)" class="js-confirm-submit"
                   data-message="Вы уверены, что хотите выполнить данный заказ?">
                  Выполнить заказ
                </a>
              </form>
            </li>
            <li>
              <form method="post" action="{{ route("cms::orders.cancel", $model->id) }}">
                @csrf

                <a href="javascript:void(0)" class="js-confirm-submit"
                   data-message="Вы уверены, что хотите отменить данный заказ?">
                  Отменить заказ
                </a>
              </form>
            </li>
          </ul>
        @endif
      </div>
    </div>
  </div>
@endsection
