<?php

use Domain\CMS\Models\ManagerRole;
use Illuminate\Database\Seeder;

class ManagerRoleSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'key' => 'admin',
            'name' => 'Администратор',
        ],
        [
            'key' => 'manager',
            'name' => 'Менеджер',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        ManagerRole::query()->truncate();

        foreach ($this->data as $data) {
            ManagerRole::query()->create($data);
        }
    }
}
