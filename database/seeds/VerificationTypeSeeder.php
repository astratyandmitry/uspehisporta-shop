<?php

use Domain\Shop\Models\VerificationType;
use Illuminate\Database\Seeder;

class VerificationTypeSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'key' => 'activation',
            'name' => 'Автивация аккаунта',
        ],
        [
            'key' => 'password-recovery',
            'name' => 'Восстановление пароля',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        VerificationType::query()->truncate();

        foreach ($this->data as $data) {
            VerificationType::query()->create($data);
        }
    }
}
