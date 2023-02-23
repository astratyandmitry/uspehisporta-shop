<?php

namespace Domain\Shop\Requests;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $street
 * @property string $house
 * @property string $postcode
 * @property string $phone
 * @property string $email
 */
class OrderRequest extends Request
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'country' => 'required|min:3',
            'region' => 'required|min:3',
            'city' => 'required|min:3',
            'street' => 'required|min:3',
            'house' => 'required',
            'postcode' => 'required|min:3',
            'phone' => 'required',
            'email' => 'required|email',
        ];
    }
}
