<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Portfolio;

class PortfolioFactory extends Factory
{
    protected $model = Portfolio::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image_url' => 'default.jpg',
            'url' => 'https://www.deepseek.com/',
        ];
    }
}