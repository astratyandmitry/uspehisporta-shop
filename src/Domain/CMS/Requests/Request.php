<?php

namespace Domain\CMS\Requests;

use Domain\CMS\Support\RequestRulesBuilder;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2019, ArmenianBros. <i@armenianbros.com>
 */
abstract class Request extends FormRequest
{
    /**
     * @var \Domain\CMS\Support\RequestRulesBuilder
     */
    protected $rulesBuilder;

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        $this->rulesBuilder = new RequestRulesBuilder($this);
        $this->buildRules();

        return $this->rulesBuilder->toArray();
    }

    /**
     * @return void
     */
    abstract protected function buildRules(): void;
}
