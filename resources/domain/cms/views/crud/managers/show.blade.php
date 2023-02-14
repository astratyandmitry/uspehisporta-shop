@php /** @var \Domain\CMS\Models\Manager $model */ @endphp

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
                @lang('cms.field.email')
              </td>
              <td>
                {{ $model->email }}
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                @lang('cms.field.role_id')
              </td>
              <td>
                {{ $model->role->name }}
              </td>
            </tr>
            @include('cms::layouts.includes.show.detail_dates')
          </table>
        </div>
      </section>
    </div>

    <div class="page-grid__right">
      <div class="block aside">
        @include('cms::layouts.includes.show.actions', [
             'delete' => $model->id !== 1,
        ])
      </div>
    </div>
  </div>
@endsection
