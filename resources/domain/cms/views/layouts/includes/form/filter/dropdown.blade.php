<select
  name="{{ $attribute }}" id="{{ $attribute }}"
  @if (isset($tabindex)) tabindex="{{ $tabindex }}" @endif
  @if (isset($required) && $required) required @endif
  @if (isset($autofocus) && $autofocus) autofocus @endif
>
  <option selected value="">{{ (isset($placeholder)) ? $placeholder : null }}</option>
  @foreach($options as $key => $option)
    @include('cms::layouts.includes.form.filter.dropdown-' . ((is_object($option)) ?  'object' : 'array'))
  @endforeach
</select>
