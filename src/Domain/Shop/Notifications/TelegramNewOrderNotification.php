<?php

namespace Domain\Shop\Notifications;

use Domain\Shop\Models\Order;
use TelegramNotifications\Messages\TelegramCollection;
use TelegramNotifications\TelegramChannel;
use Illuminate\Notifications\Notification;

class TelegramNewOrderNotification extends Notification
{
    /**
     * @var \Domain\Shop\Models\Order
     */
    protected $order;

    /**
     * @param \Domain\Shop\Models\Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toTelegram($notifiable)
    {
        $message = "<b>Новый заказ #{$this->order->id}</b>\n";

        $message .= "Клиент: {$this->order->client_name} \n";
        $message .= "Телефон: {$this->order->client_phone}";

        $message .= "\n\nТовары: ";

        foreach ($this->order->items as $item) {
            $message .= "\n — {$item->product->name} {$item->variation} ({$item->count}шт.)";
        }

        $message .= "\n\n".route('cms::orders.show', [
                'order' => $this->order,
                'token' => base64_encode(implode('_', [
                    $notifiable->id,
                    $notifiable->telegram_id,
                    str_replace('@', '-', $notifiable->email),
                ])),
            ]);

        return (new TelegramCollection)
            ->message(['text' => $message, 'parse_mode' => 'html']);
    }
}
