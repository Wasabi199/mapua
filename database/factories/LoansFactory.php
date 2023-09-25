<?php

namespace Database\Factories;

use App\Models\Loans;
use App\Models\Contributions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loans>
 */
class LoansFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
     
        $loan_type =[
            'Housing Loan',
            'Educational Loan',
            // 'Medical Reimbursement',
            'Emergency Loan',
        ];
        $aproval=[
            'Submitted',
            'For Processing',
            'Processed',
            'For Release',
            'Released',
            'Denied',
            
        ];
        $loan_status=[
            'Ongoing',
            'Paid',
        ];
        return [
            //
            'loan_type'=>$this->faker->randomElement($loan_type),
            'loan_amount'=>$this->faker->numberBetween($min = 1000, $max = 10000),
            'amount'=>$this->faker->numberBetween($min = 1000, $max = 10000),
            // 'department'=> $this->faker->randomElement($department),
            'interest'=>$this->faker->numberBetween($min = 1, $max=100),
            'approval'=>$this->faker->randomElement($aproval),
            'loan_status'=>$this->faker->randomElement($loan_status),
            'attachment1'=>'http://3.bp.blogspot.com/_R-G_62JmanY/SCAB4RHj0_I/AAAAAAAAANQ/EGLQOelOyqo/s1600/Mapua_logo.jpg',
            'attachment2'=>'http://3.bp.blogspot.com/_R-G_62JmanY/SCAB4RHj0_I/AAAAAAAAANQ/EGLQOelOyqo/s1600/Mapua_logo.jpg',
            'attachment3'=>'http://3.bp.blogspot.com/_R-G_62JmanY/SCAB4RHj0_I/AAAAAAAAANQ/EGLQOelOyqo/s1600/Mapua_logo.jpg',
            'attachment4'=>'http://3.bp.blogspot.com/_R-G_62JmanY/SCAB4RHj0_I/AAAAAAAAANQ/EGLQOelOyqo/s1600/Mapua_logo.jpg',
            // 'total_contribution'=>$this->faker->numberBetween($min = 1000, $max=1000000),
            'duration'=>$this->faker->numberBetween($min = 12, $max = 60),
        ];
    }
    public function configure(){
        return 
        $this->afterCreating(
            function(Loans $loans){
            $contribution = Contributions::factory()->make();
            $loans->contributions()->create($contribution->toArray());
            $loans->save();
        });
    }

}
