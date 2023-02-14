<ul class="pagination">
  @foreach ($elements as $element)
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
          <li class="is-active"><a href="{{ $url }}">{{ $page }}</a></li>
        @else
          <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
      @endforeach
    @endif
  @endforeach
</ul>
