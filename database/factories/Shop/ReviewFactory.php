<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Review::class;

    public function definition(): array
    {
     $dateTime = $this->faker->dateTimeThisYear();
     return [
            'title' => $this->faker->catchPhrase(),
            'content' => $this->faker->text(),
            'rating' => $this->faker->numberBetween(1, 5),
            'is_visible' => $this->faker->boolean(),
            'is_recommended' => $this->faker->boolean(),
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];
    }
}
