@php /** @var string|null $email */ @endphp

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

          @if ($message = session()->get('message'))
            <div class="message">
              {{ $message }}
            </div>
          @endif

          @include('shop::layouts.includes.form.field.input', [
              'attribute' => 'email',
              'placeholder' => 'E-mail',
              'type' => 'email',
              'required' => true,
              'autofocus' => true,
              'value' => $email,
          ])

          @include('shop::layouts.includes.form.field.password', [
              'attribute' => 'password',
              'placeholder' => 'Новый пароль',
              'required' => true,
          ])

          @include('shop::layouts.includes.form.field.password', [
              'attribute' => 'password_confirmation',
              'placeholder' => 'Подтверждение пароля',
              'required' => true,
          ])

          <button type="submit" class="form-button form-button--full">
            Сменить пароль
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
