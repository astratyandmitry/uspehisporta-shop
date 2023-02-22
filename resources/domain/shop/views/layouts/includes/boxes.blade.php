<div class="boxes">
  <h2 class="boxes-title">
    {!! $title !!}
  </h2>

  <div class="boxes-list @isset($home) boxes-list--single @endisset">
    @foreach($items as $item)
      <div class="box">
        <div class="box-icon">
          @include('shop::layouts.partials.svg.custom.'.$item['icon'])
        </div>

        <div class="box-content">
          <div class="box-title">
            {{ $item['title'] }}
          </div>

          <div class="box-detail">
            {{ $item['detail'] }}
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
