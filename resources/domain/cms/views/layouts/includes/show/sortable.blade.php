@php /** @var string $relation */ @endphp

<section>
  <div class="subheading">
    <div class="heading-text">
      <h2>{{ __("cms.model.{$relation}") }}</h2>
    </div>
  </div>

  {{ $slot }}
</section>
