@extends('shop::page.show')

@php
  /** @var \Domain\Shop\Models\Faq[] $faqs */
  $faqs = \Domain\Shop\Models\Faq::query()->get();
@endphp

@section('sub-content')
  <div class="faq-list">
    @foreach($faqs as $faq)
      <div class="faq">
        <div class="faq-heading">
          <div class="faq-question">
            {{ $faq->question }}
          </div>

          @include('shop::layouts.partials.svg.angle', ['class' => 'faq-icon js-faq-toggle'])
        </div>

        <div class="faq-answer">
          {!! $faq->answer !!}
        </div>
      </div>
    @endforeach
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const faqToggles = document.querySelectorAll('.js-faq-toggle');

      faqToggles.forEach(function (faqToggle) {
        faqToggle.addEventListener('click', function () {
          faqToggle.closest('.faq').classList.toggle('faq--active');
        });
      });
    });
  </script>
@endpush
