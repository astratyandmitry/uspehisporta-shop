@php /** @var \Domain\CMS\Models\Manager $model */ @endphp

@empty($model))
<div class="message is-sm is-warning">
  <p>@lang('cms.password-generated-mail')</p>
</div>
@endempty

<section class="block">
  <div class="section">
    @include('cms::layouts.includes.form.field.dropdown', [
        'label' => __('cms.field.role_id'),
        'attribute' => 'role_key',
        'required' => true,
        'options' => $data['roles'],
    ])

    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.email'),
        'attribute' => 'email',
        'type' => 'email',
        'required' => true,
        'autofocus' => true,
    ])
  </div>
</section>

@isset($model)
  <section class="block block--offset">
    <div class="section">
      @include('cms::layouts.includes.form.field.password', [
         'label' => __('cms.field.new_password'),
         'attribute' => 'new_password',
     ])

      @include('cms::layouts.includes.form.field.hidden', [
          'attribute' => 'password',
      ])
    </div>
  </section>
@endisset
