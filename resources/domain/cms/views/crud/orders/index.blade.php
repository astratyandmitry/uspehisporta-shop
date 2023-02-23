@php /** @var \Domain\Shop\Models\Order[] $models */ @endphp

@extends('cms::layouts.master', $globals)

@section('content')
  <main class="block">
    <div class="table">
      <table>
        <thead>
        <tr>
          <th nowrap width="88">
            @lang('cms.field.id')
          </th>
          <th nowrap>
            @lang('cms.field.client')
          </th>
          <th nowrap width="200">
            @lang('cms.field.status')
          </th>
          <th nowrap width="200">
            @lang('cms.field.info')
          </th>
          <th nowrap width="80"></th>
        </tr>
        <tr class="row--filter form">
          <th class="field">
            @include('cms::layouts.includes.form.filter.input', [
                'placeholder' => __('cms.field.id'),
                'attribute' => 'id',
            ])
          </th>
          <th class="field">
            @include('cms::layouts.includes.form.filter.input', [
               'placeholder' => 'ФИО, телефон или e-mail',
               'attribute' => 'client',
           ])
          </th>
          <th class="field">
            @include('cms::layouts.includes.form.filter.dropdown', [
               'placeholder' => __('cms.all'),
               'attribute' => 'status_id',
               'options' => $data['statuses'],
           ])
          </th>
          <th class="field">
            <div class="holder">&nbsp</div>
          </th>
          <th>
            <button type="button" class="btn btn--primary btn--sm js-filter">
              @lang('cms.action.find')
            </button>
          </th>
        </tr>
        </thead>
        <tbody>
        @if (count($models))
          @foreach($models as $model)
            <tr>
              <td nowrap class="text--center">
                <div class="text--label">
                  {{ hid($model->id) }}
                </div>
              </td>
              <td nowrap>
                <div class="text--label">
                  {{ $model->client_name }}
                </div>

                <div class="text--detail">
                  {{ $model->client_phone }}
                </div>
              </td>
              <td>
                <div class="text--label">
                  <div class="badge badge--{{ $model->status->css_color }}">
                    {{ $model->status->name }}
                  </div>
                </div>
              </td>
              <td>
                <div class="text--label">

                  <div class="badge">
                    ₽{{ number_format($model->total) }}
                  </div>

                  <div class="badge">
                    {{ $model->items()->sum('count') }} тов.
                  </div>
                </div>
              </td>
              <td nowrap class="text--center has--icon">
                @include('cms::layouts.includes.index.actions', ['edit' => false])
              </td>
            </tr>
          @endforeach
        @else
          @include('cms::layouts.includes.index.empty', ['cols' => 99])
        @endif
        </tbody>
      </table>
    </div>

    @include('cms::layouts.includes.index.pagination')
  </main>
@endsection
