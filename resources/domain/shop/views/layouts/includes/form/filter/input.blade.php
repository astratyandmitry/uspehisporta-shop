<input
  type="{{ isset($type) ? $type : 'text' }}" name="{{ $attribute }}" id="{{ $attribute }}"
  value="{{ (isset($_GET[$attribute])) ? $_GET[$attribute] : null }}"
  @if (isset($placeholder)) placeholder="{{ $placeholder }}" @endif
/>
