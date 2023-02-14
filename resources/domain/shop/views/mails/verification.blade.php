@php /** @var \Domain\Shop\Models\Verification $verification */ @endphp
@php /** @var \Domain\Shop\Models\User $user */ @endphp

@component('mail::message')
# {{ $verification->type->name }}

Ваш код для выполнения действия на сайте {{ env('APP_NAME') }}:

### **{{ $verification->code }}**

@component('mail::button', ['url' => $verification->url()])
  Активировать код
@endcomponent

@slot('subcopy')
  Данный код будет действителен до {{ $verification->expired_at->format('d.m.Y H:i') }}
@endslot
@endcomponent
