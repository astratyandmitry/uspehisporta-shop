@component('mail::message')
# {{ env('APP_NAME') }}: Доступы в админку

* **Email:** {{ $manager->email }}
* **Пароль:** {{ $password }}

@component('mail::button', ['url' => url('/cms')])
  Войти в админку
@endcomponent
@endcomponent
