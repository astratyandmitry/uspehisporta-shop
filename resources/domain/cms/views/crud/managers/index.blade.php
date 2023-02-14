@php /** @var \Domain\CMS\Models\Manager[] $models */ @endphp

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
            @lang('cms.field.email')
          </th>
          <th nowrap width="240">
            @lang('cms.field.role_id')
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
               'placeholder' => __('cms.field.email'),
               'attribute' => 'email',
           ])
          </th>
          <th class="field">
            @include('cms::layouts.includes.form.filter.dropdown', [
               'placeholder' => __('cms.all'),
               'attribute' => 'role_key',
               'options' => $data['roles']
           ])
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
                  {{ $model->email }}
                </div>
              </td>
              <td>
                <div class="text--label">
                  <a href="?role_key={{ $model->role_key }}">
                    {{ $model->role->name }}
                  </a>
                </div>
              </td>
              <td nowrap class="text--center has--icon">
                @include('cms::layouts.includes.index.actions', [
                    'delete' => $model->id !== 1,
                ])
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
