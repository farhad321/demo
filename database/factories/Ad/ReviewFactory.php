<?php

namespace Database\Factories\Ad;

use App\Models\Ad\Ad;
use App\Models\Ad\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReviewFactory extends Factory
{
 protected $model = Review::class;

 public function definition(): array
 {
  return [
   'title' => $this->faker->word(),
   'content' => $this->faker->word(),
   'is_visible' => $this->faker->boolean(),
   'created_at' => Carbon::now(),
   'updated_at' => Carbon::now(),
   'user_id' => function () {
    return User::factory()
               ->create()->id;
   },
   'ad_id' => function () {
    return Ad::factory()
             ->create()->id;
   },
  ];
 }
}
