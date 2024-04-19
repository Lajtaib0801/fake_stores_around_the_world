<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $openingTime = $this->faker->time('H:i:s', '11:00:00');
        $closingTime = $this->faker->time('H:i:s', '23:00:00');
        while ($openingTime > $closingTime) {
            $closingTime = $this->faker->time('H:i:s', '23:00:00');
        }
        return [
            'name' => $this->faker->company(),
            'city' => City::all()->random()->id,
            'address' => $this->faker->address(),
            'foundedDate' => $this->faker->dateTimeBetween('-100 years', 'now'),
            'openingTime' => $openingTime,
            'closingTime' => $closingTime,
            'picture' => $this->faker->imageUrl(640, 480, 'shop', true, 'shop'),
        ];
    }
}
