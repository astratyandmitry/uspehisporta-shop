@include('errors.error', [
    'code' => 500,
    'message' => 'Сервер недоступен',
    'action' => 'Обновить страницу',
    'url' => url()->current(),
])
