<?php

namespace Domain\CMS\Requests;

/**
 * @property string $image_desktop
 * @property string $image_mobile
 * @property string|null $url
 * @property bool $active
 */
class BannerRequest extends Request
{
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addRules([
                'image_desktop' => 'required',
                'image_mobile' => 'required',
                'url' => 'nullable',
                'active' => 'boolean',
            ]);
    }
}
