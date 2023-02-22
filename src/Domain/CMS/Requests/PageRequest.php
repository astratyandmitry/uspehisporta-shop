<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Page;

/**
 * @property string $hru
 * @property string $name
 * @property string $title
 * @property string|null $about
 * @property string $content
 * @property boolean $active
 */
class PageRequest extends Request
{
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('hru', Page::getTableName())
            ->addMetaRules()
            ->addRules([
                'hru' => 'required|max:80|alpha_dash',
                'name' => 'required|max:120',
                'title' => 'required|max:200',
                'about' => 'nullable',
                'content' => 'required',
                'active' => 'boolean',
            ]);
    }
}
