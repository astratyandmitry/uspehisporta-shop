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

  <select
    name="{{ $attribute }}" id="{{ $attribute }}"
    @if (isset($tabindex)) tabindex="{{ $tabindex }}" @endif
    @if (isset($disabled) && $disabled) disabled @endif
    @if (isset($required) && $required) required @endif
    @if (isset($autofocus) && $autofocus) autofocus @endif
  >
    <option selected value="">{{ (isset($placeholder)) ? $placeholder : '...' }}</option>
    @foreach($options as $key => $option)
      @include('cms::layouts.includes.form.field.dropdown-' . ((is_object($option)) ?  'object' : 'array'))
    @endforeach
  </select>

  @include('cms::layouts.includes.form.error')
</div>
