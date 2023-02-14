@php /** @var \App\Models\Model|null $entity */ @endphp
@php /** @var string $attribute */ @endphp
@php /** @var string|null $label */ @endphp
@php /** @var string|null $helper */ @endphp
@php /** @var string|null $placeholder */ @endphp
@php /** @var mixed $disabled */ @endphp
@php /** @var mixed $required */ @endphp
@php /** @var mixed $autofocus */ @endphp
@php /** @var array $options */ @endphp

<div class="form-field @if ($errors->has($attribute)) is-invalidate @endif">
  @if (isset($label))
    <label for="{{ $attribute }}">
            <span>
                {{ $label }}

              @if (isset($required) && $required == true)
                <strong>*</strong>
              @endif
            </span>

      @if (isset($helper))
        <span class="is-details">
                    {!! $helper !!}
                </span>
      @endif
    </label>
  @endif

  <select
    name="{{ $attribute }}" id="{{ $attribute }}"
    @if (isset($disabled) && $disabled) disabled @endif
    @if (isset($required) && $required) required @endif
    @if (isset($autofocus) && $autofocus) autofocus @endif
  >
    <option selected>{{ (isset($placeholder)) ? $placeholder : null }}</option>
    @foreach($options as $group => $data)
      @if (is_array($data))
        <optgroup label="{{ $group }}">
          @foreach($data as $key => $option)
            @include('shop::layouts.includes.form.field.dropdown-' . ((is_object($option)) ?  'object' : 'array'))
          @endforeach
        </optgroup>
      @else
        @include('shop::layouts.includes.form.field.dropdown-' . ((is_object($data)) ?  'object' : 'array'), [
            'key' => $group,
            'option' => $data,
        ])
      @endif
    @endforeach
  </select>

  @include('shop::layouts.includes.form.error')
</div>
