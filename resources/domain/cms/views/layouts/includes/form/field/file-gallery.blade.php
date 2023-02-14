@php $value = old($attribute, (isset($model)) ? $model->{$attribute} : []); @endphp

<div class="field @if ($errors->has($attribute)) field--error @endif" data-path="{{ $path }}">
  <label for="{{ $attribute }}">
        <span>
            {{ isset($label) ? $label : __('cms.field.gallery') }}

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

  <cms-uploader-gallery
    model-attribute="{{ $attribute }}"
    :uploaded-files="{{ json_encode($value ?? []) }}"
    upload-folder="{{ $path }}"
  ></cms-uploader-gallery>

  @include('cms::layouts.includes.form.error')
</div>
