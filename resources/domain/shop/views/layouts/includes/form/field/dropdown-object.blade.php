@php /** @var \App\Model|null $entity */ @endphp
@php /** @var string $attribute */ @endphp
@php /** @var object $option */ @endphp
@php /** @var string|null $display */ @endphp

<option value="{{ $option->id }}"
        @if(old($attribute, (isset($entity)) ? $entity->{$attribute} : null) == $option->id) selected @endif>
  {{ (isset($display)) ? $option->{$display} : $option->title }}
</option>
