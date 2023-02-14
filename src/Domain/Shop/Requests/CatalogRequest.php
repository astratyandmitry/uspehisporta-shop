<?php

namespace Domain\Shop\Requests;

/**
 * @property int|null $category_id
 * @property string|null $category
 * @property string|null $brand
 * @property integer|null $price_from
 * @property integer|null $price_to
 * @property string|null $sort
 * @property boolean $discount
 */
class CatalogRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'category' => 'sometimes|regex:/^\d+(,\d+)*$/i',
            'brand' => 'sometimes|regex:/^\d+(,\d+)*$/i',
            'price_from' => 'sometimes|integer',
            'price_to' => 'sometimes|integer',
            'sort' => 'sometimes|in:price.desc,price.asc,date.desc,date.asc,views.desc',
            'discount' => 'boolean',
        ];
    }
}
