@php /** @var \Domain\Shop\Models\Settings $model */ @endphp

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
                @lang('cms.field.label')
              </td>
              <td>
                {{ $model->label }}
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                @lang('cms.field.key')
              </td>
              <td>
                {{ $model->key }}
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                @lang('cms.field.value')
              </td>
              <td>
                {{ $model->value }}
              </td>
            </tr>
            @include('cms::layouts.includes.show.detail_dates')
          </table>
        </div>
      </section>
    </div>

    <div class="page-grid__right">
      <div class="block aside">
        @include('cms::layouts.includes.show.actions', ['delete' => false])
      </div>
    </div>
  </div>
@endsection
