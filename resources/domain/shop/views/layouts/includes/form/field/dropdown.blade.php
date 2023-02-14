@php /** @var \App\Model|null $entity */ @endphp
@php /** @var string $attribute */ @endphp
@php /** @var string|null $label */ @endphp
@php /** @var string|null $helper */ @endphp
@php /** @var string|null $placeholder */ @endphp
@php /** @var mixed $disabled */ @endphp
@php /** @var mixed $required */ @endphp
@php /** @var mixed $autofocus */ @endphp
@php /** @var array $options */ @endphp

<div class="form-field @if ($errors->has($attribute)) form-field--error @endif">
  @if (isset($label))
    <label class="form-label" for="{{ $attribute }}">
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

  <select class="form-input"
          name="{{ $attribute }}" id="{{ $attribute }}"
          @if (isset($disabled) && $disabled) disabled @endif
          @if (isset($required) && $required) required @endif
          @if (isset($autofocus) && $autofocus) autofocus @endif
  >
    <option selected value="">{{ (isset($placeholder)) ? $placeholder : null }}</option>
    @foreach($options as $key => $option)
      @include('shop::layouts.includes.form.field.dropdown-' . ((is_object($option)) ?  'object' : 'array'))
    @endforeach
  </select>

  @include('shop::layouts.includes.form.error')
</div>
