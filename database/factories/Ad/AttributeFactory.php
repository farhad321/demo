<?php

namespace Database\Factories\Ad;

use App\Models\Ad\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AttributeFactory extends Factory
{
 protected $model = Attribute::class;

 public function definition(): array
 {
  return [
   'name' => $this->faker->name(),
   'type' => $this->faker->randomElement([
                                          'Text',
                                          'Textarea',
                                          'Price',
                                          'Boolean',
                                          'Select',
                                          'Multiselect',
                                          'Datetime',
                                          'Date',
                                          'Image',
                                          'File',
                                          'Checkbox',
                                         ]),
   'validation' => $this->faker->word(),
   'position' => $this->faker->randomNumber(),
   'is_filterable' => $this->faker->boolean(),
   'is_visible_on_front' => $this->faker->boolean(),
   'created_at' => Carbon::now(),
   'updated_at' => Carbon::now(),
  ];
 }
}
