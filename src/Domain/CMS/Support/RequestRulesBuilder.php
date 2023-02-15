<?php

namespace Domain\CMS\Support;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class RequestRulesBuilder
{
    private array $rules = [];

    private string $table;

    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function setTable(string $table): RequestRulesBuilder
    {
        $this->table = $table;

        return $this;
    }

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

    public function addRulesWhen(bool $condition, array $rules = []): RequestRulesBuilder
    {
        if ($condition === true) {
            $this->addRules($rules);
        }

        return $this;
    }

    public function addMetaRules(): RequestRulesBuilder
    {
        $this->rules['meta_description'] = 'nullable|max:1000';
        $this->rules['meta_keywords'] = 'nullable|max:1000';

        return $this;
    }

    public function addUniqueRule(string|array $attributes, ?string $table = null): RequestRulesBuilder
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

    public function toArray(): array
    {
        return $this->rules;
    }
}
