@php /** @var \Illuminate\Database\Eloquent\Model $model */ @endphp

<tr>
  <td class="cell--key">
    @lang('cms.field.created_at')
  </td>
  <td>
    {{ $model->created_at->format('d.m.Y H:i') }}
  </td>
</tr>
@if ($model->updated_at > $model->created_at)
  <tr>
    <td class="cell--key">
      @lang('cms.field.updated_at')
    </td>
    <td>
      {{ $model->updated_at->format('d.m.Y H:i') }}
    </td>
  </tr>
@endif
