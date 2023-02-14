<section class="block block--offset">
  <div class="section">
    @include('cms::layouts.includes.form.field.textarea', [
        'label' => __('cms.field.meta_description'),
        'attribute' => 'meta_description',
    ])

    @include('cms::layouts.includes.form.field.textarea', [
        'label' => __('cms.field.meta_keywords'),
        'attribute' => 'meta_keywords',
    ])
  </div>
</section>
