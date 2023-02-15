<?php

namespace Domain\Shop\Requests;

/**
 * @property integer $product_id
 * @property string|null $variation
 */
class BasketRequest extends Request
{
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'variation' => 'nullable',
        ];
    }
}
