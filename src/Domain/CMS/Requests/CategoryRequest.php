<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Category;

class CategoryRequest extends Request
{
    /**
     * @return void
     */
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
