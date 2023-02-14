<option value="{{ $option->id }}"
        @if(old($attribute, (isset($model)) ? $model->{$attribute} : null) == $option->id) selected @endif>
  {{ (isset($display)) ? $option->{$display} : $option->title }}
</option>
