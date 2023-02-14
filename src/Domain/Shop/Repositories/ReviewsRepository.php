<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Review;
use Domain\Shop\Models\User;
use Domain\Shop\Models\Product;
use Domain\Shop\Requests\ReviewRequest;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class ReviewsRepository
{
    /**
     * @param \Domain\Shop\Models\User $user
     * @param \Domain\Shop\Models\Product $product
     * @param \Domain\Shop\Requests\ReviewRequest $request
     * @return void
     */
    public function write(User $user, Product $product, ReviewRequest $request): void
    {
        Review::query()->create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'username' => $request->username,
            'message' => $request->message,
            'rating' => $request->rating,
        ]);
    }
}
