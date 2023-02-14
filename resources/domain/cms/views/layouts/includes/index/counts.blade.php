@if (count($data['counts']))
  <div class="boxes boxes--{{ count($data['counts']) }}">
    @foreach($data['counts'] as $key => $value)
      <div class="box">
        <h6>{{ __("cms.counts.{$key}") }}</h6>

        <strong>
          {{ number_format($value) }}
        </strong>
      </div>
    @endforeach
  </div>
@endif
