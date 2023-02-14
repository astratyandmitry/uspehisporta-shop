@php /** @var \Domain\Shop\Models\Brand $model */ @endphp

<section class="block">
  <div class="section">
    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.name'),
        'attribute' => 'name',
        'required' => true,
        'autofocus' => true,
    ])

    @include('cms::layouts.includes.form.field.hru')
  </div>

  <div class="section">
    @include('cms::layouts.includes.form.field.file-image', [
        'label' => __('cms.field.logotype'),
        'attribute' => 'logotype',
        'path' => 'brands',
    ])
  </div>
</section>

@include('cms::layouts.includes.form.meta')
