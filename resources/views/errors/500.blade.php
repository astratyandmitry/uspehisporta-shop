@include('errors.error', [
    'code' => 500,
    'message' => 'Что-то пошло не так',
    'action' => 'Обновить страницу',
    'url' => url()->current(),
])
