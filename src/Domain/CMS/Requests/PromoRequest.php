<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Promo;

/**
 * @property-read string $code
 * @property-read array $categories
 * @property-read array $brands
 * @property-read float $discount
 * @property-read string $date_start
 * @property-read string $date_end
 * @property-read boolean $active
 */
class PromoRequest extends Request
{
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('code', Promo::getTableName())
            ->addRules([
                'discount' => 'required|numeric|min:0.05|max:0.95',
                'date_start' => 'required|date',
                'date_end' => 'required|date|after:date_start',
                'categories' => 'required|array',
                'brands' => 'nullable|array',
                'active' => 'boolean',
            ]);
    }
}
