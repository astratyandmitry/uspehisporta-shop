<?php

namespace Domain\Shop\Requests;

use Illuminate\Validation\Rule;

/**
 * @property string $username
 * @property string $message
 * @property integer $rating
 */
class ReviewRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'username' => 'required|min:3|max:40',
            'message' => 'required|max:800',
            'rating' => 'required|in:1,2,3,4,5',
        ];
    }
}
