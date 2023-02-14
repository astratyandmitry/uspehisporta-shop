<label class="switch">
  <input type="checkbox" data-id="{{ $model->id }}" data-model="{{ $globals['model'] }}"
         @if ($model->active) checked @endif>
  <span class="slider round"></span>
</label>
