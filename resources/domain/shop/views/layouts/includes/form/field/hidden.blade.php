@php /** @var \App\Model|null $entity */ @endphp
@php /** @var string $attribute */ @endphp
@php /** @var array $value */ @endphp

<input
  type="hidden" name="{{ $attribute }}" id="{{ $attribute }}"
  value="{{ old($attribute, (isset($entity)) ? $entity->{$attribute} : @$value) }}"
/>
