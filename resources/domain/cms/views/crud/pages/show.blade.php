@php /** @var \Domain\Shop\Models\Page $model */ @endphp

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
                @lang('cms.field.hru')
              </td>
              <td>
                {{ $model->hru }}
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                @lang('cms.field.name')
              </td>
              <td>
                {{ $model->name }}
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                @lang('cms.field.title')
              </td>
              <td>
                {{ $model->title }}
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
        @include('cms::layouts.includes.show.actions')
      </div>
    </div>
  </div>
@endsection
