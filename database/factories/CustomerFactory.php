<?php

namespace Database\Factories;

use App\Models\CategorieUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'function' => $this->faker->jobTitle,
            'avatar' => null,
            'phone' => $this->faker->phoneNumber,
            'adresse' => $this->faker->address,
            'gender' => $this->faker->randomElement(['M', 'F']),
            'created_by' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'category_id' => function () {
                return CategorieUser::inRandomOrder()->first()->id;
            },
        ];
    }
}
