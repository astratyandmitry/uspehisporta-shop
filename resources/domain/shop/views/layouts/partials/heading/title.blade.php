@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp
@php /** @var string $title */ @endphp

<h1 class="title">
  {!! isset($title) ? $title : $layout->title !!}
</h1>
