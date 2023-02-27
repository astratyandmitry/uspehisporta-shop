<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Settings;

/**
 * @property string $label
 * @property string $key
 * @property string $value
 */
class SettingsRequest extends Request
{
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addRules([
                'label' => 'required|max:80',
                'value' => 'required|max:500',
                'key' => 'sometimes',
            ]);
    }
}
