<?php

namespace Domain\Shop\Requests;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $city
 * @property string $street
 * @property string $postcode
 * @property string $phone
 * @property string $email
 * @property string|null $promo_code
 */
class OrderRequest extends Request
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'city' => 'required|min:3',
            'street' => 'required|min:3',
            'postcode' => 'required|min:3',
            'phone' => 'required',
            'email' => 'required|email',
            'promo_code' => 'nullable',
        ];
    }
}
