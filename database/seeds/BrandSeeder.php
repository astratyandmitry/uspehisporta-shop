<?php

use Domain\Shop\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'hru' => 'nike',
            'name' => 'Nike',
        ],
        [
            'hru' => 'apple',
            'name' => 'Apple',
        ],
        [
            'hru' => 'genetic-lab',
            'name' => 'GeneticLab',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        Brand::query()->truncate();

        foreach($this->data as $index => $data) {
            $data['active'] = true;
            $data['sort'] = $index;

            Brand::query()->create($data);
        }
    }
}
