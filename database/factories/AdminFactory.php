<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Faker\Provider\ar_EG\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $department = [
            'Administration',
            'Faculty'
     

        ];
   
        return [
            
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'mobile_number'=>$this->faker->phoneNumber(),
            'birth_date'=>$this->faker->date('Y-m-d', Carbon::now()->subYears(18)),
            'birth_place'=>$this->faker->city(),
    

            'department' => $this->faker->randomElement($department),
            'membership'=> $this->faker->date('Y-m-d', Carbon::now()->subYears(18)),
            'employment'=>$this->faker->date('Y-m-d', Carbon::now()->subYears(18)),
            'current_loan'=>$this->faker->numberBetween($min=1000,$max=10000),

        ];
    }
}
