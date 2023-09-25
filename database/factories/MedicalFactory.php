<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medical>
 */
class MedicalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $reimbursment =[
            'Hospital',
            'Health Checkup',
            'Dental Checkup',
            'Medicines',
            'Eye Checkup',

        ];
        $status = [
            'Pending',
            'Approved',
            'For Release',
            'Released',
        ];
        return [
            //
            'reimbursment_type' =>$this->faker->randomElement($reimbursment),
            'clinic_name'=>$this->faker->company(),
            'appointment_date'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'medical_record1'=>'http://3.bp.blogspot.com/_R-G_62JmanY/SCAB4RHj0_I/AAAAAAAAANQ/EGLQOelOyqo/s1600/Mapua_logo.jpg',
            'medical_record2'=>'http://3.bp.blogspot.com/_R-G_62JmanY/SCAB4RHj0_I/AAAAAAAAANQ/EGLQOelOyqo/s1600/Mapua_logo.jpg',
            'medical_record3'=>'http://3.bp.blogspot.com/_R-G_62JmanY/SCAB4RHj0_I/AAAAAAAAANQ/EGLQOelOyqo/s1600/Mapua_logo.jpg',
            'medical_record4'=>'http://3.bp.blogspot.com/_R-G_62JmanY/SCAB4RHj0_I/AAAAAAAAANQ/EGLQOelOyqo/s1600/Mapua_logo.jpg',
            'amount'=>$this->faker->numberBetween($max=100000000, $min=1000),
            'status'=>$this->faker->randomElement($status),
            'medical_benifit'=>$this->faker->numberBetween($max = 100, $min =0).'%',




        ];
    }
}
