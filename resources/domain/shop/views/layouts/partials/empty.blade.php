@php /** @var string $title */ @endphp
@php /** @var string $about */ @endphp
@php /** @var boolean $hideButton */ @endphp

<div class="empty">
  <div class="empty__title">
    {{ $title }}
  </div>

  <div class="empty__message">
    {{ $about }}
  </div>

  <div class="empty__action">
    <a href="{{ isset($buttonUrl)  ?  $buttonUrl : route('shop::categories') }}" class="form-button empty__button">
      {{ isset($buttonLabel) ? $buttonLabel : 'Перейти в каталог' }}
    </a>
  </div>
</div>
