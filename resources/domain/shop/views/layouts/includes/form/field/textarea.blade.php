@php /** @var \App\Model|null $entity */ @endphp
@php /** @var string $attribute */ @endphp
@php /** @var string|null $label */ @endphp
@php /** @var string|null $helper */ @endphp
@php /** @var string|null $placeholder */ @endphp
@php /** @var mixed $disabled */ @endphp
@php /** @var mixed $required */ @endphp
@php /** @var mixed $autofocus */ @endphp
@php /** @var mixed $rows */ @endphp
@php /** @var array $options */ @endphp

<div class="form-field @if ($errors->has($attribute)) form-field--error @endif">
  @if (isset($label))
    <label for="{{ $attribute }}">
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

  <textarea class="form-input"
            name="{{ $attribute }}" id="{{ $attribute }}" rows="{{ $rows ?? 3 }}"
            @if (isset($placeholder)) placeholder="{{ $placeholder }}" @endif
            @if (isset($required) && $required) required @endif
            @if (isset($disabled) && $disabled) disabled @endif
            @if (isset($autofocus) && $autofocus) autofocus @endif
    >{{ old($attribute, (isset($entity)) ? $entity->{$attribute} : @$value) }}</textarea>

  @include('shop::layouts.includes.form.error')
</div>
