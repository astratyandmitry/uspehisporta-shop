<?php

namespace Domain\Shop\Requests;

/**
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $comment
 */
class OrderRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'phone' => 'required|regex:/^(\+\d{1})\((\d{3})\)(\d{7})$/i',
            'email' => 'required|email',
            'address' => 'required|max:500|min:3',
            'comment' => 'nullable|max:1000',
        ];
    }
}
