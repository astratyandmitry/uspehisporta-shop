@extends('cms::layouts.simple', $globals)

@section('content')
  <section class="module-auth">
    <div class="container">
      <div class="wrapper">
        <section class="content">
          <div class="brand">
            <div class="logotype">
              BESTORE
            </div>
          </div>

          <section class="block">
            <form method="post" class="form">
              @csrf

              @include('cms::layouts.includes.form.field.input', [
                  'placeholder' => __('cms.field.email'),
                  'attribute' => 'email',
                  'type' => 'email',
                  'autofocus' => true,
                  'required' => true,
              ])

              @include('cms::layouts.includes.form.field.input', [
                 'placeholder' => __('cms.field.password'),
                 'attribute' => 'password',
                 'type' => 'password',
                 'required' => true,
             ])

              @include('cms::layouts.includes.form.field.checkbox', [
                 'label' => __('cms.field.remember'),
                 'attribute' => 'remember',
                 'hidden' => false,
             ])

              <div class="text--right">
                <button type="submit" class="btn btn--primary">
                  @lang('cms.action.login')
                </button>
              </div>
            </form>
          </section>

          <div class="copyright">
            &copy; {{ date('Y') }} ArmenianBros.
          </div>
        </section>
      </div>
    </div>
  </section>
@endsection

@push('styles')
  <style>
    body {
      background: #fafafa;
    }
  </style>
@endpush

