<?php

namespace Database\Seeders;

use Domain\Shop\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    protected array $data = [
        [
            'question' => 'Первый вопрос',
            'answer' => 'Ответ на первый вопрос',
        ],
        [
            'question' => 'Второй вопрос',
            'answer' => 'Ответ на второй вопрос',
        ],
        [
            'question' => 'Третий вопрос',
            'answer' => 'Ответ на третий вопрос',
        ],
    ];

    public function run(): void
    {
        Faq::query()->truncate();

        foreach($this->data as $index => $data) {
            $data['active'] = true;
            $data['sort'] = $index;

            Faq::query()->create($data);
        }
    }
}
