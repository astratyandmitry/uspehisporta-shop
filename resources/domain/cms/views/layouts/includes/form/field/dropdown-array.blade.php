<option value="{{ $key }}"
        @if(old($attribute, (isset($model)) ? $model[$attribute] : @$forceValue) == $key) selected @endif>
  {{ $option }}
</option>
