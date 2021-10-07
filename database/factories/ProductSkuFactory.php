<?php

namespace Database\Factories;

use App\Models\ProductSku;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductSkuFactory extends Factory
{
    protected $model = ProductSku::class;

    public function definition()
    {
        return [
            'title'       => $this->faker->word,
            'description' => $this->faker->sentence,
            'stock'       => $this->faker->randomNumber(5),
        ];
    }
}
