@php /** @var array $globals */ @endphp
@php /** @var string $local_model */ @endphp
@php /** @var \Domain\Shop\Models\Model $model */ @endphp

@php $model_name = isset($local_model) ? $local_model : $globals['model'] @endphp

<ul class="navigation">
  @if (method_exists($model, 'link'))
    <li>
      <a href="{{ $model->link() }}" target="_blank">
        @lang('cms.action.link')
      </a>
    </li>
  @endif

  @if ( ! isset($edit) || $edit !== false)
    <li>
      <a href="{{ route("cms::{$globals['model']}.edit", $model->id) }}">
        @lang('cms.action.edit')
      </a>
    </li>
  @endif

  @if (isset($delete) && $delete === true)
    <li>
      <form method="post" action="{{ route("cms::{$globals['model']}.destroy", $model->id) }}">
        @csrf @method('DELETE')

        <a href="javascript:void(0)" class="js-confirm-submit" data-message="@lang('cms.delete')">
          @lang('cms.action.delete')
        </a>
      </form>
    </li>
  @endif
</ul>
