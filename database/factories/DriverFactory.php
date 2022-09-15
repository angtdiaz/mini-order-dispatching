<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    protected $model = Driver::class;
    /**
     * Define the model's default state.
     *
     * 
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(1, true),
            'lat' => $this->faker->randomFloat(5, -3, -2),
            'lng' => $this->faker->randomFloat(5, -80, -79)

        ];
    }
}
