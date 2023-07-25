@php
    $attribute = str_replace('[]', '', $attribute);
    $compareValue = $forceValue ?? null;

    if (isset($model)) {
        if (! is_array($model[$attribute])) {
            $compareValue = $model[$attribute];
        } elseif (in_array($key, $model[$attribute])) {
            $compareValue = $key;
        }
    }
@endphp

<option value="{{ $key }}"
        @if(old($attribute, $compareValue) == $key) selected @endif>
  {{ $option }}
</option>
