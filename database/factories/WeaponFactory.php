<?php

namespace Database\Factories;

use App\Models\Guard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WeaponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->word,
            'serie_number' => $this->faker->word,
            'acquisition_date' => $this->faker->date,
            'state' => $this->faker->randomElement(['En possession', 'Non possession']),
            'guard_id' => function () {
                // Insérez une garde existante ou laissez-la nullable (null)
                return Guard::inRandomOrder()->first()?->id;
            },

        ];

    }
}
