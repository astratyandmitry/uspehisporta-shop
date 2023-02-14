<input
  type="hidden" name="{{ $attribute }}" id="{{ $attribute }}"
  @if (isset($forceValue))
  value="{{ $forceValue }}"
  @else
  value="{{ old($attribute, (isset($model)) ? $model->{$attribute} : @$value) }}"
  @endif
/>
