<div class="field @if ($errors->has($attribute)) field--error @endif">
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

  <input
    type="password" name="{{ $attribute }}" id="{{ $attribute }}"
    value="{{ old($attribute, (isset($model)) ? $model->{$attribute} : null) }}"
    @if (isset($placeholder)) placeholder="{{ $placeholder }}" @endif
    @if (isset($tabindex)) tabindex="{{ $tabindex }}" @endif
    @if (isset($disabled) && $disabled) disabled @endif
    @if (isset($required) && $required) required @endif
    @if (isset($autofocus) && $autofocus) autofocus @endif
  />

  @if (isset($model))
    <input type="hidden" name="{{ "old_{$attribute}" }}" value="{{ $model->$attribute }}"/>
  @endif

  @include('cms::layouts.includes.form.error')
</div>
