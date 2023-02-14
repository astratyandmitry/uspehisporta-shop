<div class="action">
  <button type="submit" class="btn btn--primary">
    {{ (isset($model)) ? __('cms.action.update') : __('cms.action.create') }}
  </button>

  <span class="btn--between">@lang('cms.or')</span>

  <a href="{{ \URL::previous() }}" class="btn btn--sm">
    @lang('cms.action.cancel')
  </a>
</div>
