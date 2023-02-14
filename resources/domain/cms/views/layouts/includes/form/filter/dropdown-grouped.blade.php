<select
  name="{{ $attribute }}" id="{{ $attribute }}"
  @if (isset($tabindex)) tabindex="{{ $tabindex }}" @endif
  @if (isset($required) && $required) required @endif
  @if (isset($autofocus) && $autofocus) autofocus @endif
>
  <option selected value="">{{ (isset($placeholder)) ? $placeholder : null }}</option>
  @foreach($options as $group => $data)
    @if (is_array($data))
      <optgroup label="{{ $group }}">
        @foreach($data as $key => $option)
          @include('cms::layouts.includes.form.filter.dropdown-' . ((is_object($option)) ?  'object' : 'array'))
        @endforeach
      </optgroup>
    @else
      @include('cms::layouts.includes.form.filter.dropdown-' . ((is_object($data)) ?  'object' : 'array'), [
          'key' => $group,
          'option' => $data,
      ])
    @endif
  @endforeach
</select>
