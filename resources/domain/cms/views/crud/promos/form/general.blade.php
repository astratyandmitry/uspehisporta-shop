@php /** @var \Domain\Shop\Models\Promo $model */ @endphp

<section class="block">
  <div class="section">
    <div class="form-grid form-grid--2">
      @include('cms::layouts.includes.form.field.input', [
          'label' => __('cms.field.code'),
          'attribute' => 'code',
          'required' => true,
          'autofocus' => true,
          'disabled' => isset($model),
      ])

      @include('cms::layouts.includes.form.field.input', [
          'label' => __('cms.field.discount'),
          'helper' => '0.05 ... 0.95',
          'attribute' => 'discount',
          'required' => true,
          'type' => 'number',
          'step' => '0.05',
      ])
    </div>

    <div class="form-grid form-grid--2">
      @include('cms::layouts.includes.form.field.input', [
          'label' => __('cms.field.date_start'),
          'attribute' => 'date_start',
          'required' => true,
          'type' => 'date',
      ])

      @include('cms::layouts.includes.form.field.input', [
          'label' => __('cms.field.date_end'),
          'attribute' => 'date_end',
          'required' => true,
          'type' => 'date',
      ])
    </div>
  </div>

  @unless($model))
    <div class="section">
      @include('cms::layouts.includes.form.field.dropdown-grouped', [
           'label' => __('cms.field.category_id'),
           'attribute' => 'categories[]',
           'required' => true,
           'multiple' => true,
           'options' => $data['categories'],
       ])
    </div>
  @endunless
</section>
