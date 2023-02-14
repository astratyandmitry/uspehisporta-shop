@php $value = old($attribute, (isset($model)) ? $model->{$attribute} : null); @endphp

<div class="field @if ($errors->has($attribute)) field--error @endif" data-path="{{ $path }}">
  @if (isset($label))
    <label for="{{ $attribute }}">
            <span>
                {{ $label }}

              @if (isset($required) && $required == true)
                <strong>*</strong>
              @endif
            </span>

      @if (isset($helper))
        <span class="text--detail">
                    {!! $helper !!}
                </span>
      @endif
    </label>
  @endif

  <input type="hidden" class="js-upload-multi-hide" name="{{ $attribute }}" value="{{ implode(',', (array)$value) }}">

  <input class="hidden js-upload-multi-file" multiple type="file" accept="{{ (isset($accept)) ? $accept : '*' }}"/>

  <div class="file">
    <button type="button" class="btn btn--primary btn--outlined js-upload-multi">
      <i class="fa fa-upload"></i>
      @lang('cms.action.file-gallery')
    </button>
  </div>

  <div class="js-upload-multi-files">
    @if ($value && count($value))
      @php $value = (is_array($value)) ? $value : explode(',', $value) @endphp
      @foreach($value as $file)
        @if (!$file) @continue @endif
        <div class="js-upload-multi-files-item">
          <div class="js-upload-multi-files-item-delete">x</div>
          <img src="{{ $file }}">
        </div>
      @endforeach
    @endif
  </div>

  @include('cms::layouts.includes.form.error')
</div>
