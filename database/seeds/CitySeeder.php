<?php

use Domain\Shop\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'name' => 'Алматы',
            'phone' => '+7(777)1233214',
            'address' => 'ул. Алматинская 101',
        ],
        [
            'name' => 'Нур-Султан',
            'phone' => '+7(708)1233214',
            'address' => 'ул. Астанинская 202',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        City::query()->truncate();

        foreach ($this->data as $data) {
            City::query()->create($data);
        }
    }
}
