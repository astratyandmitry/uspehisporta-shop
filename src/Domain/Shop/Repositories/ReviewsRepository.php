<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Review;
use Domain\Shop\Models\User;
use Domain\Shop\Models\Product;
use Domain\Shop\Requests\ReviewRequest;

class ReviewsRepository
{
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
