@php /** @var \Domain\Shop\Models\Page $page */ @endphp

@extends('shop::layouts.master', ['layout' => $layout])

@section('content')
  <div class="page">
    <div class="container">
      <div class="page__grid">
        <div class="page__content">
          <form method="post" class="auth__content">
            @csrf

            @if ($message = session()->get('message'))
              <div class="message">
                {{ $message }}
              </div>
            @endif

            @include('shop::layouts.includes.form.field.password', [
                'attribute' => 'current_password',
                'placeholder' => 'Текущий пароль',
                'required' => true,
            ])

            @include('shop::layouts.includes.form.field.password', [
                'attribute' => 'password',
                'placeholder' => 'Новый пароль',
                'required' => true,
            ])

            @include('shop::layouts.includes.form.field.password', [
                'attribute' => 'password_confirmation',
                'placeholder' => 'Подтверждение нового пароля',
                'required' => true,
            ])

            <button type="submit" class="form-button">
              Изменить пароль
            </button>
          </form>
        </div>

        <div class="page__aside">
          @include('shop::account.partials.aside')
        </div>
      </div>
    </div>
  </div>
@endsection
