@php /** @var array $globals */ @endphp
@php /** @var string $local_model */ @endphp
@php /** @var \Domain\Shop\Models\Model $model */ @endphp

@php $model_name = isset($local_model) ? $local_model : $globals['model'] @endphp

@if (method_exists($model, 'link') && ( ! isset($link) || $link != false))
  <a href="{{ $model->link() }}" target="_blank" title="@lang('cms.action.link')" class="tooltip">
        <span class="tooltip-message">
            @lang('cms.action.link')
        </span>

    <i class="fas fa-globe-americas"></i>
  </a>
@endif

@if ( ! isset($show) || $show != false)
  <a href="{{ route("cms::{$model_name}.show", $model->id) }}" title="@lang('cms.action.show')"
     class="tooltip">
        <span class="tooltip-message">
            @lang('cms.action.show')
        </span>

    <i class="far fa-eye"></i>
  </a>
@endif

@if ( ! isset($edit) || $edit != false)
  <a href="{{ route("cms::{$model_name}.edit", $model->id) }}" title="@lang('cms.action.edit')"
     class="tooltip">
        <span class="tooltip-message">
            @lang('cms.action.edit')
        </span>

    <i class="far fa-edit"></i>
  </a>
@endif

@if (isset($delete) && $delete === true)
  <form method="post" action="{{ route("cms::{$model_name}.destroy", $model->id) }}">
    @csrf @method('DELETE')

    <a href="javascript:void(0)" class="tooltip js-confirm-submit js-is-ajax"
       title="@lang('cms.action.delete')" data-message="@lang('cms.delete')">
            <span class="tooltip-message">
                @lang('cms.action.delete')
            </span>

      <i class="fas fa-trash-alt"></i>
    </a>
  </form>
@endif
