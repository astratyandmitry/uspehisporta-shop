@php /** @var \Domain\Shop\Models\Banner $model */ @endphp

@extends('cms::layouts.master', $globals)

@section('content')
  <div class="page-grid">
    <div class="page-grid__left">
      <section class="block">
        <div class="table table--card">
          <table>
            @include('cms::layouts.includes.show.detail_id')
            @if ($model->url)
              <tr>
                <td class="cell--key">
                  @lang('cms.field.url')
                </td>
                <td>
                  {{ $model->url }}
                </td>
              </tr>
            @endif
            <tr>
              <td class="cell--key">
                @lang('cms.field.image') Desktop
              </td>
              <td class="cell--image">
                <img src="{{ $model->image_desktop }}" classs>
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                @lang('cms.field.title') Mobile
              </td>
              <td class="cell--image">
                <img src="{{ $model->image_mobile }}" classs>
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
