@php /** @var \Domain\Shop\Models\Brand $model */ @endphp

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
            @if ($model->about)
              <tr>
                <td class="cell--key">
                  @lang('cms.field.about')
                </td>
                <td>
                  {{ $model->about }}
                </td>
              </tr>
            @endif
            @if ($model->logotype)
              <tr>
                <td class="cell--key">
                  @lang('cms.field.logotype')
                </td>
                <td class="cell--image">
                  <a href="{{ $model->logotype }}" target="_blank">
                    <img src="{{ $model->logotype }}">
                  </a>
                </td>
              </tr>
            @endif
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
