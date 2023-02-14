@php /** @var \Domain\Shop\Models\Product[] $models */ @endphp

@extends('cms::layouts.master', $globals)

@section('content')
  <main class="block">
    <div class="table">
      <table>
        <thead>
        <tr>
          <th nowrap width="64"></th>
          <th nowrap width="88">
            @lang('cms.field.id')
          </th>
          <th nowrap>
            @lang('cms.field.info')
          </th>
          <th nowrap width="320">
            @lang('cms.field.category_id')
          </th>
          <th nowrap width="200">
            @lang('cms.field.brand_id')
          </th>
          <th nowrap width="54"></th>
          <th nowrap width="80"></th>
        </tr>
        <tr class="row--filter form">
          <th class="field">
            <div class="holder">&nbsp</div>
          </th>
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
          <th class="field">
            @include('cms::layouts.includes.form.filter.dropdown-grouped', [
               'placeholder' => __('cms.all'),
               'attribute' => 'category_id',
               'options' => $data['categories'],
           ])
          </th>
          <th class="field">
            @include('cms::layouts.includes.form.filter.dropdown', [
               'placeholder' => __('cms.all'),
               'attribute' => 'brand_id',
               'options' => $data['brands'],
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
              <td nowrap class="cell--image text--center">
                <img src="{{ $model->image }}">
              </td>
              <td nowrap class="text--center">
                <div class="text--label">
                  {{ hid($model->id) }}
                </div>
              </td>
              <td nowrap>
                <div class="text--label">
                  {{ $model->name }}
                </div>

                <div class="text--detail">
                  @if ($model->price_sale)
                    <strike>{{ price($model->price) }}₸</strike>
                    {{ price($model->price_sale) }}₸
                  @else
                    {{ price($model->price) }}₸
                  @endif
                </div>
              </td>
              <td>
                <div class="text--label">
                  <a href="?category_id={{ $model->category_id }}">
                    {{ $model->category->name }}
                  </a>
                </div>
              </td>
              <td>
                <div class="text--label">
                  <a href="?brand_id={{ $model->brand_id }}">
                    {{ $model->brand->name }}
                  </a>
                </div>
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

    @include('cms::layouts.includes.index.pagination')
  </main>
@endsection
