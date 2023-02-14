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

  <cms-uploader
    accept="{{ (isset($accept)) ? $accept : '*' }}"
    model-attribute="{{ $attribute }}"
    uploaded-file="{{ $value }}"
    upload-folder="{{ $path }}"
  ></cms-uploader>

  @include('cms::layouts.includes.form.error')
</div>
