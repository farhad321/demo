<?php

namespace Database\Factories\Ad;

use App\Models\Ad\Ad;
use App\Models\Address\City;
use App\Models\Address\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AdFactory extends Factory
{
 protected $model = Ad::class;

 public function definition(): array
 {
  return [
   'title' => $this->faker->word(),
   'slug' => $this->faker->slug(),
   'description' => $this->faker->text(),
   'is_visible' => $this->faker->boolean(),
   'price' => $this->faker->randomFloat(2, 0, 999888777),
   'seo_title' => $this->faker->text(60),
   'seo_description' => $this->faker->text(160),
   'views' => $this->faker->randomNumber(),
   'attributes' => $this->faker->words(),
   'created_at' => Carbon::now(),
   'updated_at' => Carbon::now(),
//   'user_id' => function () {
//    return User::factory()
//               ->create()->id;
//   },
//   'state_id' => function () {
//    return State::factory()
//                ->create()->id;
//   },
//   'city_id' => function () {
//    return City::factory()
//               ->create()->id;
//   },
  ];
 }
}
