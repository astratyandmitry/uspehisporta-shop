@php /** @var \Domain\Shop\Models\Category $model */ @endphp

<section class="block">
  <div class="section">
    @include('cms::layouts.includes.form.field.file-image', [
          'label' => __('cms.field.image'),
          'helper' => 'Для компьютера (1920x425)',
          'attribute' => 'image_desktop',
          'path' => 'banners',
          'required' => true,
    ])

    @include('cms::layouts.includes.form.field.file-image', [
          'label' => __('cms.field.image'),
          'helper' => 'Для телефона (768x360)',
          'attribute' => 'image_mobile',
          'path' => 'banners',
          'required' => true,
    ])
  </div>

  <div class="section">
    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.url'),
        'attribute' => 'url',
    ])
  </div>
</section>
