<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Category;

/**
 * @property string $hru
 * @property integer|null $parent_id
 * @property string $name
 * @property string $title
 * @property string|null $image
 * @property boolean $active
 */
class CategoryRequest extends Request
{
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('hru', Category::getTableName())
            ->addMetaRules()
            ->addRulesWhen(! is_null($this->get('parent_id')), [
                'parent_id' => 'required|exists:categories,id',
            ])
            ->addRulesWhen(is_null($this->get('parent_id')), [
                'parent_id' => 'nullable',
            ])
            ->addRules([
                'hru' => 'required|max:80|alpha_dash',
                'name' => 'required|max:120',
                'title' => 'required|max:200',
                'image' => 'nullable',
                'active' => 'boolean',
            ]);
    }
}
