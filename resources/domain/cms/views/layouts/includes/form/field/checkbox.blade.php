<div class="field field--checkbox @if ($errors->has($attribute)) field--error @endif">
  @if ( ! isset($hidden) || $hidden === true)
    <input type="hidden" name="{{ $attribute }}" value="0">
  @endif

  <input
    id="{{ $attribute }}" name="{{ $attribute }}" type="checkbox" value="1"
    @if(old($attribute, @$model->{$attribute}) == 1) checked @endif
    @if (isset($tabindex)) tabindex="{{ $tabindex }}" @endif
    @if (isset($disabled) && $disabled) disabled @endif
    @if (isset($required) && $required) required @endif
    @if (isset($autofocus) && $autofocus) autofocus @endif
  >

  <label for="{{ $attribute }}">
        <span>
            {{ $label }}

          @if (isset($required) && $required == true)
            <strong>*</strong>
          @endif
        </span>
  </label>

  @include('cms::layouts.includes.form.error')
</div>
