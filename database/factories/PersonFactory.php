<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isMale = $this->faker->boolean();
        return [
            'name' => $isMale ? $this->faker->firstNameMale() . ' ' . $this->faker->lastName() : $this->faker->firstNameFemale() . ' ' . $this->faker->lastName(),
            'birthday' => $this->faker->dateTimeBetween('-100 years', '-16 years'),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'isMale' => $isMale,
            'picture' => $this->faker->imageUrl(),
        ];
    }
}
