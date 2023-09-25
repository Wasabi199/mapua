<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserNotifications>
 */
class UserNotificationsFactory extends Factory
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
            'user_id'=>$this->faker->numberBetween($max = 50,$min = 1),
            'universal_id'=>$this->faker->numberBetween($max = 50,$min = 1),
            'value'=>$this->faker->sentence(),
            'isRead'=>$this->faker->boolean(),
            'type'=>$this->faker->numberBetween($max = 3,$min = 1),
            'notification_type'=>$this->faker->numberBetween($max = 6, $min=1),
        ];
    }
}
