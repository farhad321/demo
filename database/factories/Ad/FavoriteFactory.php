<?php

namespace Database\Factories\Ad;

use App\Models\Ad\Favorite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FavoriteFactory extends Factory
{
 protected $model = Favorite::class;

 public function definition(): array
 {
  return [
   'created_at' => Carbon::now(),
   'updated_at' => Carbon::now(),
   'user_id' => $this->faker->randomNumber(),
   'ad_id' => $this->faker->randomNumber(),
  ];
 }
}
