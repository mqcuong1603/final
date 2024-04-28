<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'barcode' => $this->faker->unique()->ean13(),
            'product_name' => $this->faker->words(3, true),
            'import_price' => $this->faker->randomFloat(2, 100, 1000),
            'retail_price' => $this->faker->randomFloat(2, 100, 1500),
            'category' => $this->faker->word(),
            'creation_date' => $this->faker->dateTimeThisYear(),
        ];
    }
}
