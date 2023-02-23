@php /** @var \Domain\Shop\Models\Product $model */ @endphp

<section class="block">
  <div class="section">
    <div class="form-grid form-grid--2">
      @include('cms::layouts.includes.form.field.dropdown-grouped', [
          'label' => __('cms.field.category_id'),
          'attribute' => 'category_id',
          'required' => true,
          'options' => $data['categories'],
      ])

      @include('cms::layouts.includes.form.field.dropdown', [
          'label' => __('cms.field.brand_id'),
          'attribute' => 'brand_id',
          'required' => true,
          'options' => $data['brands'],
      ])
    </div>
  </div>

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
    @include('cms::layouts.includes.form.field.input', [
      'label' => 'Ярлыки',
      'helper' => '— разделять через запятую',
      'attribute' => 'badges',
  ])
  </div>

  <div class="section">
    @include('cms::layouts.includes.form.field.file-image', [
        'path' => 'products',
        'required' => true,
    ])

    @include('cms::layouts.includes.form.field.file-gallery', [
        'attribute' => 'gallery',
        'path' => 'products',
    ])
  </div>

  <div class="section section--last">
    @include('cms::layouts.includes.form.field.ckeditor5', [
        'label' => __('cms.field.about'),
        'attribute' => 'about',
        'required' => true,
    ])
  </div>

  <div class="section section--last">
    @include('cms::layouts.includes.form.field.ckeditor5', [
        'label' => __('cms.field.characteristics'),
        'attribute' => 'characteristics',
    ])
  </div>
</section>

<input type="hidden" name="variations" value="[]">

{{--<product-config :variations=@json(isset($model) ? $model->variations : []) />--}}

@include('cms::layouts.includes.form.meta')
