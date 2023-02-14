<?php

namespace Domain\CMS\Requests;

class BannerRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addRules([
                'position_key' => 'required|exists:banner_positions,key',
                'title' => 'required|max:500',
                'url' => 'required|url',
                'image' => 'required',
                'image_mobile' => 'required',
                'active' => 'boolean',
            ]);
    }
}
