@php /** @var \Domain\Shop\Models\Settings $model */ @endphp

<section class="block">
  <div class="section">
    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.label'),
        'attribute' => 'label',
        'required' => true,
        'autofocus' => true,
    ])

    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.key'),
        'attribute' => 'key',
        'required' => true,
        'disabled' => true,
    ])

    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.value'),
        'attribute' => 'value',
        'required' => true,
    ])
  </div>
</section>
