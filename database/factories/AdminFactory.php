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
            "School of Architecture, Industrial Design, and the Built Environment",

            "School of Chemical, Biological, and Materials Engineering and Sciences",

           "School of Civil, Environmental, and Geological Engineering",

           "School of Electrical, Electronics, and Computer Engineering",

            "School of Industrial Engineering and Engineering Management",

            "School of Mechanical and Manufacturing Engineering",

            "School of Media Studies",

            "School of Social Sciences and Education",

            "Department of Arts and Letters",

            "Department of Mathematics",

           "Department of Physics",

            "School of Information Technology",

            "E.T. Yuchengo School of Business in collaboration with Arizona State University",

            "Admin office(Treasury, Registrar, Admission)",

            "Maintenance",

        ];
        $civil_status = [
            'Single',
            'Maried',
            'Widowed',
            'Divorced',
        ];
        $member_type=[
            'Teaching',
            'Non-Teaching',
        ];
        return [
            //
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'mobile_number'=>$this->faker->phoneNumber(),
            'birth_date'=>$this->faker->date('Y-m-d', Carbon::now()->subYears(18)),
            'birth_place'=>$this->faker->city(),
            'civil_status'=>$this->faker->randomElement($civil_status),

            // 'region'=> $this->faker->state(),
            // 'province'=> $this->faker->cityPrefix(),
            // 'municipality'=> $this->faker->city(),
            // 'barangay'=> $this->faker->streetName(),
            // 'current_address'=> $this->faker->buildingNumber(),

            'department' => $this->faker->randomElement($department),
            'salary' => $this->faker->numberBetween($min=1000,$max=10000),
            'membership'=> $this->faker->date('Y-m-d', Carbon::now()->subYears(18)),
            'employment'=>$this->faker->date('Y-m-d', Carbon::now()->subYears(18)),
            'current_loan'=>$this->faker->numberBetween($min=1000,$max=10000),

        ];
    }
}
