<?php

namespace Database\Seeders;

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
            'hru' => PAGE_HOME,
        ],
        [
            'name' => 'Каталог',
            'title' => 'Каталог товаров',
            'hru' => PAGE_CATALOG,
        ],
        [
            'name' => 'Вопросы и ответы',
            'title' => 'Вопросы и ответы',
            'hru' => PAGE_FAQ,
        ],
        [
            'name' => 'Поиск',
            'title' => 'Поиск товаров',
            'hru' => PAGE_SEARCH,
        ],
        [
            'name' => 'Корзина',
            'title' => 'Ваша корзина',
            'hru' => PAGE_BASKET,
        ],
        [
            'name' => 'Оформление заказа',
            'title' => 'Оформление заказа',
            'hru' => PAGE_CHECKOUT,
        ],
        [
            'name' => 'Вход',
            'title' => 'Вход',
            'hru' => PAGE_AUTH_LOGIN,
        ],
        [
            'name' => 'Регистрация',
            'title' => 'Регистрация',
            'hru' => PAGE_AUTH_REGISTER,
        ],
        [
            'name' => 'Восстановление пароля',
            'title' => 'Восстановление пароля',
            'hru' => PAGE_AUTH_PASSWORD_RECOVERY,
        ],
        [
            'name' => 'Запрос пароля',
            'title' => 'Запрос пароля',
            'hru' => PAGE_AUTH_PASSWORD_RESET,
        ],
        [
            'name' => 'Текущие заказы',
            'title' => 'Текущие заказы',
            'hru' => PAGE_ACCOUNT_ORDERS_CURRENT,
        ],
        [
            'name' => 'История заказов',
            'title' => 'История заказов',
            'hru' => PAGE_ACCOUNT_ORDERS_HISTORY,
        ],
        [
            'name' => 'Детали заказа',
            'title' => 'Детали заказа',
            'hru' => PAGE_ACCOUNT_ORDER,
        ],
        [
            'name' => 'Настройки',
            'title' => 'Личные настройки',
            'hru' => PAGE_ACCOUNT_SETTINGS_PERSONAL,
        ],
        [
            'name' => 'Безопасность',
            'title' => 'Настройки безопасности',
            'hru' => PAGE_ACCOUNT_SETTINGS_SECURITY,
        ],
        [
            'name' => 'Отзыв о товаре',
            'title' => 'Оставить отзыв о товаре',
            'hru' => PAGE_PRODUCT_REVIEW,
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
