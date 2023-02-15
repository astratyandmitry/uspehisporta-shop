<?php

namespace Domain\CMS\Requests;

use Domain\CMS\Support\RequestRulesBuilder;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    protected RequestRulesBuilder $rulesBuilder;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->rulesBuilder = new RequestRulesBuilder($this);
        $this->buildRules();

        return $this->rulesBuilder->toArray();
    }

    abstract protected function buildRules(): void;
}
