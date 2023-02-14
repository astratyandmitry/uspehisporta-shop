<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Product;

class ProductRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('hru', Product::getTableName())
            ->addMetaRules()
            ->addRules([
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'quantity' => 'nullable',
                'price' => 'required|integer|min:1',
                'price_sale' => 'nullable',
                'gallery' => 'nullable',
                'variations' => 'nullable',
                'hru' => 'required|max:80|alpha_dash',
                'name' => 'required|max:120',
                'image' => 'required',
                'about' => 'required',
                'characteristics' => 'nullable',
                'badges' => 'nullable',
                'active' => 'boolean',
                'featured' => 'boolean',
            ]);
    }
}
