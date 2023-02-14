@php /** @var \Domain\Shop\Models\Banner $model */ @endphp

<section class="block">
  <div class="section">
    @include('cms::layouts.includes.form.field.dropdown', [
        'label' => __('cms.field.position_key'),
        'attribute' => 'position_key',
        'required' => true,
        'options'=> $data['positions'],
    ])

    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.title'),
        'attribute' => 'title',
        'required' => true,
        'autofocus' => true,
    ])

    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.url'),
        'attribute' => 'url',
        'required' => true,
    ])
  </div>

  <div class="section">
    @include('cms::layouts.includes.form.field.file-image', [
        'label' => __('cms.field.image'),
        'attribute' => 'image',
        'path' => 'banners',
        'required' => true,
    ])

    @include('cms::layouts.includes.form.field.file-image', [
        'label' => __('cms.field.image_mobile'),
        'attribute' => 'image_mobile',
        'path' => 'banners',
        'required' => true,
    ])
  </div>
</section>
