@php /** @var \Domain\Shop\Models\Faq $model */ @endphp

<section class="block">
  <div class="section">
    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.author'),
        'attribute' => 'author',
        'required' => true,
        'autofocus' => true,
    ])

    @include('cms::layouts.includes.form.field.textarea', [
        'label' => __('cms.field.message'),
        'attribute' => 'message',
        'required' => true,
    ])

    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.url'),
        'attribute' => 'url',
        'required' => true,
        'type' => 'url',
    ])
  </div>
</section>
