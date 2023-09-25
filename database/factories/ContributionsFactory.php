<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Loans;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contributions>
 */
class ContributionsFactory extends Factory
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
            'contribution_amount'=>$this->faker->numberBetween($min = 1000, $max=1000000),
        ];
    }
    
}
