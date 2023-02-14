@php /** @var \Domain\Shop\Models\Product $model */ @endphp

<div class="section">
  @include('cms::layouts.includes.form.field.input', [
      'label' => __('cms.field.quantity'),
      'attribute' => 'quantity',
      'required' => true
  ])

  @include('cms::layouts.includes.form.field.input', [
      'label' => __('cms.field.price'),
      'attribute' => 'price',
      'required' => true
  ])

  @include('cms::layouts.includes.form.field.input', [
      'label' => __('cms.field.price_sale'),
      'attribute' => 'price_sale',
  ])
</div>

<div class="section">
  @include('cms::layouts.includes.form.field.checkbox', [
      'label' => __('cms.field.featured'),
      'attribute' => 'featured',
  ])

  @include('cms::layouts.includes.form.field.checkbox', [
      'label' => __('cms.field.active'),
      'attribute' => 'active',
  ])
</div>
