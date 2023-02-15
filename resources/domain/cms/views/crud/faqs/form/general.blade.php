@php /** @var \Domain\Shop\Models\Faq $model */ @endphp

<section class="block">
  <div class="section">
    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.question'),
        'attribute' => 'question',
        'required' => true,
        'autofocus' => true,
    ])

    @include('cms::layouts.includes.form.field.ckeditor5', [
        'label' => __('cms.field.answer'),
        'attribute' => 'answer',
        'required' => true,
    ])
  </div>
</section>
