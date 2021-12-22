<?php

namespace Database\Factories\Address;

use App\Models\Address\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StateFactory extends Factory
{
 protected $model = State::class;

 public function definition(): array
 {
  return [
   'name' => $this->faker->name(),
   'created_at' => Carbon::now(),
   'updated_at' => Carbon::now(),
  ];
 }
}
