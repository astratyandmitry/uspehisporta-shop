<?php

namespace Database\Seeders;

use Domain\Shop\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    protected array $data = [
        [
            'label' => 'URL_FORUM_DO4A',
            'key' => SETTINGS_URL_FORUM_DO4A,
            'value' => '#',
        ],
        [
            'label' => 'URL_FORUM_ANABOLICS',
            'key' => SETTINGS_URL_FORUM_ANABOLICS,
            'value' => '#',
        ],
        [
            'label' => 'URL_TELEGRAM_GROUP',
            'key' => SETTINGS_URL_TELEGRAM_GROUP,
            'value' => '#',
        ],
        [
            'label' => 'URL_TELEGRAM_PRICE',
            'key' => SETTINGS_URL_TELEGRAM_PRICE,
            'value' => '#',
        ],
        [
            'label' => 'URL_TELEGRAM_OPERATOR',
            'key' => SETTINGS_URL_TELEGRAM_OPERATOR,
            'value' => '#',
        ],
        [
            'label' => 'URL_TELEGRAM_CONSULTING',
            'key' => SETTINGS_URL_TELEGRAM_CONSULTING,
            'value' => '#',
        ],
    ];

    public function run(): void
    {
        Settings::query()->truncate();

        foreach ($this->data as $item) {
            Settings::query()->create($item);
        }
    }
}
