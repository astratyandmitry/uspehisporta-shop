@component('mail::message')
# {{ env('APP_NAME') }}: CMS Access

* **Email:** {{ $manager->email }}
* **Password:** {{ $password }}

@component('mail::button', ['url' => url('/cms')])
  Login to CMS
@endcomponent
@endcomponent
