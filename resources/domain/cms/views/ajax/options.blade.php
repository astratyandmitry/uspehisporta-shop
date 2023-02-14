@php /** @var array $options */ @endphp
@php /** @var int|null $selected */ @endphp

<option value="">...</option>
@if (count($options))
  @foreach($options as $id => $value)
    @if(is_array($value))
      <optgroup label="{{ $id }}">
        @foreach($value as $key => $option)
          <option value="{{ $key }}" @if ($selected == $key) selected @endif>{{ $option }}</option>
        @endforeach
      </optgroup>
    @else
      <option value="{{ $id }}" @if ($selected == $id) selected @endif>{{ $value }}</option>
    @endif
  @endforeach
@endif
