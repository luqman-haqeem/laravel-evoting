<?php

namespace Database\Factories;

use App\Voter;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'faculties_id' => $this->faker->numberBetween(0, 5),
            'matric_number' =>  $this->faker->randomNumber(6, true),
            'name' => $this->faker->name(),
        ];
    }
}
