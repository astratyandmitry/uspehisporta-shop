<?php

namespace Domain\CMS\Support;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class RequestRulesBuilder
{
    /**
     * @var array
     */
    private $rules = [];

    /**
     * @var string
     */
    private $table;

    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $table
     * @return \Domain\CMS\Support\RequestRulesBuilder
     */
    public function setTable(string $table): RequestRulesBuilder
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @param array $rules
     * @return \Domain\CMS\Support\RequestRulesBuilder
     */
    public function addRules(array $rules = []): RequestRulesBuilder
    {
        foreach ($rules as $attribute => $validation) {
            if (! isset($this->rules[$attribute])) {
                $this->rules[$attribute] = $validation;
            } else {
                $this->rules[$attribute] .= '|'.$validation;
            }
        }

        return $this;
    }

    /**
     * @param bool $condition
     * @param array $rules
     * @return \Domain\CMS\Support\RequestRulesBuilder
     */
    public function addRulesWhen(bool $condition, array $rules = []): RequestRulesBuilder
    {
        if ($condition === true) {
            $this->addRules($rules);
        }

        return $this;
    }

    /**
     * @return \Domain\CMS\Support\RequestRulesBuilder
     */
    public function addMetaRules(): RequestRulesBuilder
    {
        $this->rules['meta_description'] = 'nullable|max:1000';
        $this->rules['meta_keywords'] = 'nullable|max:1000';

        return $this;
    }

    /**
     * @param string|array $attributes
     * @param string|null $table
     * @return \Domain\CMS\Support\RequestRulesBuilder
     */
    public function addUniqueRule($attributes, ?string $table = null): RequestRulesBuilder
    {
        if (! is_array($attributes)) {
            $attributes = (array) $attributes;
        }

        foreach ($attributes as $attribute) {
            $rule = Rule::unique($table ?? $this->table);

            if ($this->request->isMethod('PATCH')) {
                $rule->whereNot('id', (int) $this->request->segment(3));
            }

            if (isset($this->rules[$attribute])) {
                $this->rules[$attribute] .= '|'.$rule;
            } else {
                $this->rules[$attribute] = $rule;
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->rules;
    }
}
