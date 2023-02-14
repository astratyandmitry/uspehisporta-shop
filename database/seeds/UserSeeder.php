<?php

use Domain\Shop\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'email' => 'user@mail.ru',
            'city_id' => 1,
            'name' => 'Иван Иванов',
            'phone' => '+7(777)7777777',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        User::query()->truncate();

        foreach ($this->data as $data) {
            $data['password'] = bcrypt('password');
            $data['activated_at'] = now();

            User::query()->create($data);
        }
    }
}
