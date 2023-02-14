@php /** @var \Illuminate\Database\Eloquent\Model $model */ @endphp

<tr>
  <td class="cell--key">
    @lang('cms.field.status')
  </td>
  <td>
    @if ($model->active)
      <div class="badge badge--success">
        @lang('cms.filter.active')
      </div>
    @else
      <div class="badge badge--danger">
        @lang('cms.filter.not-active')
      </div>
    @endif
  </td>
</tr>
