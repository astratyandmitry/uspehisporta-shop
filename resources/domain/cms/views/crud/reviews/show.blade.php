@php /** @var \Domain\Shop\Models\Review $model */ @endphp

@extends('cms::layouts.master', $globals)

@section('content')
  <div class="page-grid">
    <div class="page-grid__left">
      <section class="block">
        <div class="table table--card">
          <table>
            @include('cms::layouts.includes.show.detail_id')
            <tr>
              <td class="cell--key">
                @lang('cms.field.user_id')
              </td>
              <td>
                {{ $model->user->email }}
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                @lang('cms.field.product_id')
              </td>
              <td>
                {{ $model->product->name }}
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                @lang('cms.field.message')
              </td>
              <td>
                {!! nl2br($model->message) !!}
              </td>
            </tr>
            @include('cms::layouts.includes.show.detail_active')
            @include('cms::layouts.includes.show.detail_dates')
          </table>
        </div>
      </section>
    </div>

    <div class="page-grid__right">
      <div class="block aside">
        @include('cms::layouts.includes.show.actions', ['edit' => false, 'delete' => true])
      </div>
    </div>

  </div>
@endsection
