<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Product;

/**
 * @property string $hru
 * @property integer $brand_id
 * @property integer|null $quantity
 * @property integer $price
 * @property integer|null $price_sale
 * @property string|null $gallery
 * @property string|null $variations
 * @property string $name
 * @property string $image
 * @property string $about
 * @property string|null $badges
 * @property boolean $active
 * @property boolean $featured
 * @property array $categories_ids
 */
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
                'categories_ids' => 'required|array',
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
                'badges' => 'nullable',
                'active' => 'boolean',
                'hot_sale' => 'boolean',
            ]);
    }
}
