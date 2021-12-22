<?php

namespace Database\Factories\Address;

use App\Models\Address\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CityFactory extends Factory
{
 protected $model = City::class;

 public function definition(): array
 {
  return [
   'name' => $this->faker->name(),
   'created_at' => Carbon::now(),
   'updated_at' => Carbon::now(),
   'state_id' => $this->faker->randomNumber(),
  ];
 }
}
