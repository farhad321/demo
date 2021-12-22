<?php

namespace Database\Factories\Ad;

use App\Models\Ad\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CategoryFactory extends Factory
{
 protected $model = Category::class;

 public function definition(): array
 {
  return [
   'name' => $this->faker->name(),
   'slug' => $this->faker->slug(),
   'description' => $this->faker->text(),
   'position' => $this->faker->randomNumber(1),
   'is_visible' => $this->faker->boolean(),
   'seo_title' => $this->faker->text(60),
   'seo_description' => $this->faker->text(160),
   'attributes' => $this->faker->words(),
   'created_at' => Carbon::now(),
   'updated_at' => Carbon::now(),
//   'parent_id' => function () {
//    return Category::factory()
//                   ->create()->id;
//   },
  ];
 }
}
