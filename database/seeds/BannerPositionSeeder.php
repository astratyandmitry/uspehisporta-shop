<?php

use Domain\Shop\Models\BannerPosition;
use Illuminate\Database\Seeder;

class BannerPositionSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'key' => 'home.main',
            'name' => 'Основной на главной',
        ],
        [
            'key' => 'products.split',
            'name' => 'Между товарами',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        BannerPosition::query()->truncate();

        foreach($this->data as $data) {
            BannerPosition::query()->create($data);
        }
    }
}
