<?php

namespace Database\Seeders;

use Domain\Shop\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'hru' => 'hgh',
            'name' => 'Гормон роста',
            'title' => 'Гормон роста',
        ],
        [
            'hru' => 'anabolic-steroids',
            'name' => 'Анаболические стероиды',
            'title' => 'Анаболические стероиды',
        ],
        [
            'hru' => 'methanol',
            'name' => 'Метанол',
            'title' => 'Метанол',
        ],
        [
            'hru' => 'sarms',
            'name' => 'SARMS',
            'title' => 'SARMS',
        ],
        [
            'hru' => 'gonadotropin',
            'name' => 'Гонадотропин (ХГЧ)',
            'title' => 'Гонадотропин (ХГЧ)',
        ],
        [
            'hru' => 'peptides',
            'name' => 'Пептиды',
            'title' => 'Пептиды',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        Category::query()->truncate();

        foreach ($this->data as $index => $data) {
            $data['parent_id'] = null;
            $data['image'] = "/images/img.png";
            $data['active'] = true;
            $data['about'] = 'Приглашаем клиентов в СПб и других городах воспользоваться услугами нашего магазина «Успехи спорта». Мы обеспечиваем своих покупателей лучшими условиями, соответствующими приобретению гормонов роста. Также вы можете познакомиться с фото анализов представленной продукции, прикрепленных в галерее. Мы гарантируем оперативную доставку, лучшую цену продукта, а также обеспечиваем высококачественной спортивной фармакологией в ассортименте, произведенной на проверенных зарубежных и отечественных производствах.';
            $data['sort'] = $index;

            /** @var \Domain\Shop\Models\Category $category */
            $category = Category::query()->create($data);

            //for ($i = 1; $i <= 4; $i++) {
            //    Category::query()->create([
            //        'parent_id' => $category->id,
            //        'hru' => "{$category->hru}_child-{$i}",
            //        'name' => "{$category->name} дочерняя {$i}",
            //        'title' => "{$category->name} дочерняя {$i}",
            //        'about' => 'Some about text',
            //        'active' => true,
            //        'sort' => "{$index}{$i}",
            //    ]);
            //}
        }
    }
}
