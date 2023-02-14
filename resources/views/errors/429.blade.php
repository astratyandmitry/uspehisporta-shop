@include('errors.error', [
    'code' => 429,
    'message' => 'Слишком много запросов',
    'action' => 'Обновить страницу',
    'url' => url()->current(),
])
