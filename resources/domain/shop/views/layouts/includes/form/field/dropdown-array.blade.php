@php /** @var \App\Model|null $entity */ @endphp
@php /** @var string $attribute */ @endphp
@php /** @var string $key */ @endphp
@php /** @var string $option */ @endphp

<option value="{{ $key }}" @if(old($attribute, (isset($entity)) ? $entity[$attribute] : null) == $key) selected @endif>
  {{ $option }}
</option>
