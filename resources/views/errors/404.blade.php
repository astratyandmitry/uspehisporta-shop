@include('errors.error', [
    'code' => 404,
    'message' => 'Страница не найдена',
    'action' => 'Перейти на главную',
    'url' => route('shop::home'),
])
