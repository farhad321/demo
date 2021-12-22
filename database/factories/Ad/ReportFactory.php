<?php

namespace Database\Factories\Ad;

use App\Models\Ad\Ad;
use App\Models\Ad\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReportFactory extends Factory
{
 protected $model = Report::class;

 public function definition(): array
 {
  return [
   'title' => $this->faker->word(),
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
