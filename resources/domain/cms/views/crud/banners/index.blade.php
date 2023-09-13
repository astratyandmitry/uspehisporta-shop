@php /** @var \Domain\Shop\Models\Banner[] $models */ @endphp
@php /** @var boolean $sortable */ @endphp

@extends('cms::layouts.master', $globals)

@section('content')
  <main class="block">
    <div class="table">
      <table>
        <thead>
        <tr>
          <th nowrap width="12"></th>
          <th nowrap width="88">
            @lang('cms.field.id')
          </th>
          <th nowrap>
            @lang('cms.field.info')
          </th>
          <th nowrap width="54"></th>
          <th nowrap width="80"></th>
        </tr>
        </thead>
        <tbody class="js-sortable" data-model="{{ $globals['model'] }}">
        @if (count($models))
          @foreach($models as $model)
            <tr data-id="{{ $model->id }}">
              <td nowrap class="is-icon text--center has--icon">
                <i class="fas fa-bars js-sortable-handle"></i>
              </td>
              <td nowrap class="text--center">
                <div class="text--label">
                  {{ hid($model->id) }}
                </div>
              </td>
              <td nowrap>
                <img src="{{ $model->image_mobile }}" alt="" style="height: 80px">
              </td>
              <td>
                @include('cms::layouts.includes.index.switch')
              </td>
              <td nowrap class="text--center has--icon">
                @include('cms::layouts.includes.index.actions')
              </td>
            </tr>
          @endforeach
        @else
          @include('cms::layouts.includes.index.empty', ['cols' => 99])
        @endif
        </tbody>
      </table>
    </div>

    @if (!$sortable)
      @include('cms::layouts.includes.index.pagination')
    @endif
  </main>
@endsection
