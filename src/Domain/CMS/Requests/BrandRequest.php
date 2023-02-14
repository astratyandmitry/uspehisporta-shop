<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Brand;

class BrandRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('hru', Brand::getTableName())
            ->addMetaRules()
            ->addRules([
                'hru' => 'required|max:40|alpha_dash',
                'name' => 'required|max:80',
                'logotype' => 'nullable',
                'active' => 'boolean',
            ]);
    }
}
