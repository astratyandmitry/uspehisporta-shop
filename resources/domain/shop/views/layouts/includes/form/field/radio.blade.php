@php /** @var \App\Model|null $entity */ @endphp
@php /** @var string $attribute */ @endphp
@php /** @var string|null $label */ @endphp
@php /** @var mixed $value */ @endphp
@php /** @var mixed $disabled */ @endphp
@php /** @var mixed $required */ @endphp

<div class="form-field form-field--radio @if ($errors->has($attribute)) form-field--error @endif">
  <input type="hidden" name="{{ $attribute }}" value="0">

  <div class="form-field__value">
    <input class="form-field__value"
           id="{{ $attribute }}_{{ $value }}" name="{{ $attribute }}" type="radio" value="{{ $value }}"
           @if(old($attribute, @$entity->{$attribute}) == 1) checked @endif
           @if (isset($disabled) && $disabled) disabled @endif
           @if (isset($required) && $required) required @endif
    >

    <label for="{{ $attribute }}_{{ $value }}" class="form-label">
      {{ $label }}
    </label>
  </div>

  @include('shop::layouts.includes.form.error')
</div>
