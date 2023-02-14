<?php

use Domain\CMS\Models\Manager;
use Domain\CMS\Models\ManagerRole;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'role_key' => MANAGER_ROLE_ADMIN,
            'email' => 'astratyandmitry@gmail.com',
            'password' => 'aveego',
        ],
        [
            'role_key' => MANAGER_ROLE_ADMIN,
            'email' => 'admin@ura-shop.kz',
            'password' => 'admin',
        ],
        [
            'role_key' => MANAGER_ROLE_MANAGER,
            'email' => 'manager@ura-shop.kz',
            'password' => 'manager',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        Manager::query()->truncate();

        foreach ($this->data as $data) {
            $data['password'] = bcrypt($data['password']);

            Manager::query()->create($data);
        }
    }
}
