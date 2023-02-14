@php /** @var \App\Model|null $entity */ @endphp
@php /** @var string $attribute */ @endphp
@php /** @var string|null $label */ @endphp
@php /** @var string|null $helper */ @endphp
@php /** @var string|null $placeholder */ @endphp
@php /** @var mixed $disabled */ @endphp
@php /** @var mixed $required */ @endphp
@php /** @var mixed $autofocus */ @endphp
@php /** @var mixed $value */ @endphp

<div class="form-field @if ($errors->has($attribute)) form-field--error @endif">
  @if (isset($label))
    <label for="{{ $attribute }}" class="form-label">
      {{ $label }}

      @if (isset($required) && $required == true)
        <strong>*</strong>
      @endif

      @if (isset($helper))
        <span class="form-help">
                    {!! $helper !!}
                </span>
      @endif
    </label>
  @endif

  <input class="form-input"
         type="{{ isset($type) ? $type : 'text' }}" name="{{ $attribute }}" id="{{ $attribute }}"
         value="{{ old($attribute, (isset($entity)) ? $entity->{$attribute} : @$value) }}"
         @if (isset($placeholder)) placeholder="{{ $placeholder }}" @endif
         @if (isset($disabled) && $disabled) disabled @endif
         @if (isset($required) && $required) required @endif
         @if (isset($autofocus) && $autofocus) autofocus @endif
         @if (isset($accept) && $accept) accept="{{ $accept }}" @endif
  />

  @include('shop::layouts.includes.form.error')
</div>
