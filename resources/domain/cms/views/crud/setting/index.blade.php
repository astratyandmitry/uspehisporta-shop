@php /** @var \Domain\Shop\Models\Settings[] $models */ @endphp
@php /** @var boolean $sortable */ @endphp

@extends('cms::layouts.master', $globals)

@section('content')
  <main class="block">
    <div class="table">
      <table>
        <thead>
        <tr>
          @if ($sortable)
            <th nowrap width="12"></th>
          @endif
          <th nowrap width="88">
            @lang('cms.field.id')
          </th>
          <th nowrap>
            @lang('cms.field.info')
          </th>
          <th nowrap width="80"></th>
        </tr>
        <tr class="row--filter form">
          @if ($sortable)
            <th class="field"></th>
          @endif
          <th class="field">
            @include('cms::layouts.includes.form.filter.input', [
                'placeholder' => __('cms.field.id'),
                'attribute' => 'id',
            ])
          </th>
          <th class="field">
            @include('cms::layouts.includes.form.filter.input', [
               'placeholder' => __('cms.field.info'),
               'attribute' => 'info',
           ])
          </th>
          <th>
            <button type="button" class="btn btn--primary btn--sm js-filter">
              @lang('cms.action.find')
            </button>
          </th>
        </tr>
        </thead>
        <tbody @if ($sortable) class="js-sortable" data-model="{{ $globals['model'] }}" @endif>
        @if (count($models))
          @foreach($models as $model)
            <tr data-id="{{ $model->id }}">
              @if ($sortable)
                <td nowrap class="is-icon text--center has--icon">
                  <i class="fas fa-bars js-sortable-handle"></i>
                </td>
              @endif
              <td nowrap class="text--center">
                <div class="text--label">
                  {{ hid($model->id) }}
                </div>
              </td>
              <td nowrap>
                <div class="text--label">
                  {{ $model->label }}
                </div>

                <div class="text--detail">
                  {{ $model->key }}
                </div>
              </td>
              <td nowrap class="text--center has--icon">
                @include('cms::layouts.includes.index.actions', ['delete' => false])
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
