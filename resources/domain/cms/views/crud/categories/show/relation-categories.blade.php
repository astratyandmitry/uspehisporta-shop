@php /** @var \Domain\Shop\Models\Category $model */ @endphp

@if (count($model->children))
  @component('cms::layouts.includes.show.sortable', ['relation' => $relation = 'categories'])
    <section class="block block--offset">
      <div class="table">
        <table>
          <thead>
          <tr>
            <th width="12"></th>
            <th nowrap>
              @lang('cms.field.info')
            </th>
            <th nowrap width="80"></th>
          </tr>
          </thead>
          <tbody class="js-sortable" data-model="{{ $relation }}">
          @foreach($model->children as $item)
            <tr data-id="{{ $item->id }}">
              <td nowrap class="text--center has--icon">
                <i class="fas fa-bars js-sortable-handle"></i>
              </td>
              <td nowrap>
                <div class="text--label">
                  {{ $item->name }}
                </div>

                <div class="text--detail">
                  {{ $item->hru }}
                </div>
              </td>
              <td nowrap class="text--center has--icon">
                @include('cms::layouts.includes.index.actions', [
                    'local_model' => $relation,
                    'model' => $item,
                    'show' => false,
                ])
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </section>
  @endcomponent
@endif
