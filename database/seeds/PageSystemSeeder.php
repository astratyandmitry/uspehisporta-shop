<?php

use Domain\Shop\Models\Page;
use Illuminate\Database\Seeder;

class PageSystemSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'name' => 'Главная',
            'title' => 'Главная страница',
            'hru' => 'home',
        ],
        [
            'name' => 'Каталог',
            'title' => 'Каталог товаров',
            'hru' => 'catalog',
        ],
        [
            'name' => 'Поиск',
            'title' => 'Поиск товаров',
            'hru' => 'search',
        ],
        [
            'name' => 'Корзина',
            'title' => 'Ваша корзина',
            'hru' => 'basket',
        ],
        [
            'name' => 'Вход',
            'title' => 'Вход',
            'hru' => 'auth.login',
        ],
        [
            'name' => 'Регистрация',
            'title' => 'Регистрация',
            'hru' => 'auth.register',
        ],
        [
            'name' => 'Восстановление пароля',
            'title' => 'Восстановление пароля',
            'hru' => 'auth.password.recovery',
        ],
        [
            'name' => 'Запрос пароля',
            'title' => 'Запрос пароля',
            'hru' => 'auth.password.reset',
        ],
        [
            'name' => 'Текущие заказы',
            'title' => 'Текущие заказы',
            'hru' => 'account.orders.current',
        ],
        [
            'name' => 'История заказов',
            'title' => 'История заказов',
            'hru' => 'account.orders.history',
        ],
        [
            'name' => 'Детали заказа',
            'title' => 'Детали заказа',
            'hru' => 'account.order',
        ],
        [
            'name' => 'Настройки',
            'title' => 'Личные настройки',
            'hru' => 'account.settings.personal',
        ],
        [
            'name' => 'Безопасность',
            'title' => 'Настройки безопасности',
            'hru' => 'account.settings.security',
        ],
        [
            'name' => 'Отзыв о товаре',
            'title' => 'Оставить отзыв о товаре',
            'hru' => 'product.review',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        Page::query()->where('system', true)->delete();

        foreach ($this->data as $data) {
            $data['active'] = true;
            $data['system'] = true;
            $data['content'] = null;

            Page::query()->create($data);
        }
    }
}
