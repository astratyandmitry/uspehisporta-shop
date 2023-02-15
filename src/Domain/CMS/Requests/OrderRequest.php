<?php

namespace Domain\CMS\Requests;

/**
 * @property integer $status_id
 */
class OrderRequest extends Request
{
    protected function buildRules(): void
    {
        $this->rulesBuilder->addRules([
            'status_id' => 'required|exists:order_statuses,id',
        ]);
    }
}
