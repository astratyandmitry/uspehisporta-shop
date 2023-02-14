@include('errors.error', [
    'code' => 419,
    'message' => 'Срок действия истек',
    'action' => 'Повторить попытку',
    'url' => url()->previous(),
])
