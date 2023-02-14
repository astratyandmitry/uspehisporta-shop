<?php

use Domain\Shop\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'position_key' => BANNER_POS_HOME_MAIN,
            'title' => 'Первый баннер',
            'url' => 'http://geneticshop.kz',
        ],
        [
            'position_key' => BANNER_POS_HOME_MAIN,
            'title' => 'Второй баннер',
            'url' => 'http://geneticshop.kz',
        ],
        [
            'position_key' => BANNER_POS_HOME_MAIN,
            'title' => 'Третий баннер',
            'url' => 'http://geneticshop.kz',
        ],
        [
            'position_key' => BANNER_POS_PRODUCTS_SPLIT,
            'title' => 'Разделяющий первый',
            'url' => 'http://geneticshop.kz',
        ],
        [
            'position_key' => BANNER_POS_PRODUCTS_SPLIT,
            'title' => 'Разделяющий второй',
            'url' => 'http://geneticshop.kz',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        Banner::query()->truncate();

        foreach($this->data as $index => $data) {
            $data['image'] = "/images/banners/{$index}.jpeg";
            $data['image_mobile'] = "/images/banners/{$index}.jpeg";
            $data['active'] = true;
            $data['sort'] = $index;

            Banner::query()->create($data);
        }
    }
}
