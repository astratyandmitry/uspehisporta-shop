<?php

namespace Domain\CMS\Requests;

class OrderRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder->addRules([
            'status_id' => 'required|exists:order_statuses,id',
        ]);
    }
}
