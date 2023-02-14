@extends('shop::layouts.master')

@section('content')
  <div class="auth">
    <div class="container container--sm">
      <div class="auth__form">
        <h1 class="auth__title">
          {{ $layout->title }}
        </h1>

        <form method="post" class="auth__content">
          @csrf

          @include('shop::layouts.includes.form.field.input', [
              'attribute' => 'name',
              'placeholder' => 'ФИО',
              'required' => true,
          ])

          @include('shop::layouts.includes.form.field.input', [
              'attribute' => 'phone',
              'placeholder' => 'Номер телефона',
              'required' => true,
          ])

          @include('shop::layouts.includes.form.field.input', [
              'attribute' => 'email',
              'placeholder' => 'E-mail',
              'type' => 'email',
              'required' => true,
          ])

          @include('shop::layouts.includes.form.field.password', [
              'attribute' => 'password',
              'placeholder' => 'Пароль',
              'required' => true,
          ])

          @include('shop::layouts.includes.form.field.password', [
              'attribute' => 'password_confirmation',
              'placeholder' => 'Подтверждение пароля',
              'required' => true,
          ])

          <button type="submit" class="form-button form-button--full form-button--register">
            Зарегистрироваться
          </button>

          <div class="auth__action">
            <a href="{{ route('shop::auth.login') }}">
              Войти в аккаунт
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection


@push('scripts')
  <script src="https://unpkg.com/imask"></script>
  <script>
    IMask(document.getElementById('phone'), {
      mask: '+{7}(000)0000000'
    })
  </script>
@endpush
