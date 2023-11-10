<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GuardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'function' => $this->faker->jobTitle,
            'degree' => $this->faker->word,
            'service' => $this->faker->word,
            'unite' => $this->faker->word,
            'role_id' => function () {
                return Role::inRandomOrder()->first()->id; // Assurez-vous que la table des rôles existe
            },
            'user_id' => function () {
                return User::inRandomOrder()->first()->id; // Assurez-vous que la table des utilisateurs existe
            },
            'avatar' => null, // Vous pouvez définir la valeur par défaut pour 'avatar' (dans cet exemple, null).
            'birth_date' => $this->faker->date,
            'adresse' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'hire_date' => $this->faker->date,
        ];
    }
}
