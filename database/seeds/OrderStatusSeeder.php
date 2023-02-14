<?php

use Domain\Shop\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'key' => ORDER_STATUS_CREATED,
            'name' => 'Создан',
        ],
        [
            'key' => ORDER_STATUS_COMPLETED,
            'name' => 'Выполнен',
        ],
        [
            'key' => ORDER_STATUS_CANCELED,
            'name' => 'Отменен',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        OrderStatus::query()->truncate();

        foreach ($this->data as $data) {
            OrderStatus::query()->create($data);
        }
    }
}
