@php /** @var \Domain\Shop\Models\Category $model */ @endphp

<section class="block">
  <div class="section">
    @include('cms::layouts.includes.form.field.dropdown', [
          'label' => __('cms.field.parent_id'),
          'attribute' => 'parent_id',
          'options' => $data['parents'],
    ])

    @include('cms::layouts.includes.form.field.input', [
          'label' => __('cms.field.name'),
          'attribute' => 'name',
          'required' => true,
          'autofocus' => true,
    ])

    @include('cms::layouts.includes.form.field.hru')

    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.title'),
        'attribute' => 'title',
        'required' => true,
    ])
  </div>

  <div class="section">
    @include('cms::layouts.includes.form.field.file-image', [
        'label' => __('cms.field.image'),
        'attribute' => 'image',
        'path' => 'categories',
    ])
  </div>
</section>

@include('cms::layouts.includes.form.meta')
