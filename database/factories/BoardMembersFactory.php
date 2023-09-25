<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoardMembers>
 */
class BoardMembersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'chairman' => $this->faker->name($gender = null | 'male' | 'female'),
            'committee_chairman' => $this->faker->name($gender = null | 'male' | 'female'),
            // 'benefits_chairman' => $this->faker->name($gender = null | 'male' | 'female'),
            'vice_chairman' => $this->faker->name($gender = null | 'male' | 'female'),
            'corporate_secretary' => $this->faker->name($gender = null | 'male' | 'female'),
            'treasurer' => $this->faker->name($gender = null | 'male' | 'female'),
            'internal_auditor' => $this->faker->name($gender = null | 'male' | 'female'),
            'accountant' => $this->faker->name($gender = null | 'male' | 'female'),
        ];
    }
}
