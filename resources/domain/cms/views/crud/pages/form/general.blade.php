@php /** @var \Domain\Shop\Models\Page $model */ @endphp

<section class="block">
  <div class="section">
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
    @include('cms::layouts.includes.form.field.ckeditor5', [
        'label' => __('cms.field.content'),
        'attribute' => 'content',
    ])
  </div>
</section>

@include('cms::layouts.includes.form.meta')
