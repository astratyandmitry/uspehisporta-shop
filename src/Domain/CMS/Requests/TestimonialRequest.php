<?php

namespace Domain\CMS\Requests;

/**
 * @property string $author
 * @property string $message
 * @property string|null $url
 * @property boolean $active
 */
class TestimonialRequest extends Request
{
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addRules([
                'author' => 'required|max:80',
                'url' => 'required|url|max|500',
                'active' => 'boolean',
            ]);
    }
}
