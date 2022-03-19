<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => rand(181150531000,1811505310450),
            'grade' => rand(1,10),
            'phone' => $this->faker->unique()->phoneNumber(),
            'birthday' => $this->faker->date('Y-m-d',$max = 'now'),
            'address' => $this->faker->address(),
            'user_id' =>rand(1,5),
        ];
    }
}
