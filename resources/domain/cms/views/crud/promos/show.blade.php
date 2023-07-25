@php /** @var \Domain\Shop\Models\Promo $model */ @endphp

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
                @lang('cms.field.code')
              </td>
              <td>
                {{ $model->code }} ({{ $model->discount * 100 }}%)
              </td>
            </tr>
            <tr>
              <td class="cell--key">
                Даты
              </td>
              <td>
                {{ date('d.m.Y', strtotime($model->date_start)) }} — {{ date('d.m.Y', strtotime($model->date_end)) }}
              </td>
            </tr>
            @if (is_array($model->categories) && count($model->categories))
              <tr>
                <td class="cell--key">
                  @lang('cms.field.category_id')
                </td>
                <td>
                  @php $categories = \Domain\Shop\Models\Category::query()->whereIn('id', $model->categories)->get(); @endphp
                  <ul>
                    @foreach($categories as $category)
                      <li>{{ $category->name }}</li>
                    @endforeach
                  </ul>
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
