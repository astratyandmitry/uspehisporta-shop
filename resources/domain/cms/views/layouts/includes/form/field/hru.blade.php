@include('cms::layouts.includes.form.field.input', [
    'label' => __('cms.field.hru'),
    'attribute' => 'hru',
    'helper' => config('app.url') . '/{example-hru-123}',
    'required' => true,
    'disabled' => isset($model),
])

@isset($model)
  @include('cms::layouts.includes.form.field.hidden', [
      'attribute' => 'hru',
  ])
@endisset

@push('scripts')
  @include('cms::layouts.includes.script.hru', [
      'source' => isset($source) ? $source : 'name',
  ])
@endpush
