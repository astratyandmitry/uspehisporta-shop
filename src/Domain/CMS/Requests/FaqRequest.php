<?php

namespace Domain\CMS\Requests;

/**
 * @property string $question
 * @property string $answer
 */
class FaqRequest extends Request
{
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addRules([
                'question' => 'required|max:120',
                'answer' => 'required',
                'active' => 'boolean',
            ]);
    }
}
